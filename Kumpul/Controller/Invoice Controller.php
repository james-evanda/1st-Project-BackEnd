namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function create()
    {
        $cartItems = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cartItems))->get();
        
        return view('invoices.create', compact('cartItems', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|min:10|max:100',
            'postal_code' => 'required|string|size:5|regex:/^[0-9]+$/',
        ]);

        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        $total = 0;
        $products = Product::whereIn('id', array_keys($cartItems))->get();
        
        foreach ($products as $product) {
            if ($product->quantity < $cartItems[$product->id]) {
                return redirect()->back()
                    ->with('error', "Insufficient stock for {$product->name}");
            }
            $total += $product->price * $cartItems[$product->id];
        }

        $invoice = Invoice::create([
            'invoice_number' => 'INV-' . time(),
            'user_id' => auth()->id(),
            'shipping_address' => $request->shipping_address,
            'postal_code' => $request->postal_code,
            'total_amount' => $total
        ]);

        foreach ($products as $product) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'quantity' => $cartItems[$product->id],
                'price' => $product->price,
                'subtotal' => $product->price * $cartItems[$product->id]
            ]);

            $product->update([
                'quantity' => $product->quantity - $cartItems[$product->id]
            ]);
        }

        session()->forget('cart');

        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Order placed successfully!');
    }

    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }
}