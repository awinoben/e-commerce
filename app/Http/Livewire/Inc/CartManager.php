<?php

namespace App\Http\Livewire\Inc;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartManager extends Component
{
    public $cartItems = [];
    public $subtotal = 0;

    protected function getListeners()
    {
        return [
            'updatePlus' => 'updateCartPlus',
            'updateMinus' => 'updateCartMinus',
            'add' => 'addCart',
            'remove' => 'removeCart',
            'destroy' => 'destroyCart'
        ];
    }

    public function mount()
    {
        $this->cartItems = Cart::instance('shopping')->content();
        $this->subtotal = Cart::instance('shopping')->subtotal();
    }

    public function updateCartPlus(string $id, string $instance, int $quantity = 1)
    {
        $cart = Cart::instance($instance)->get($id);
        $product = $cart->model;
        if ($cart->qty >= $product->available_quantity) {
            $this->cartItems = Cart::instance($instance)->content();
            $this->subtotal = Cart::instance($instance)->subtotal();
            $this->alert('warning', 'We are sorry that no more stock is available for ' . $product->name);
        } else {
            $quantity++;
            $cart = Cart::instance($instance)->update($id, $quantity); // Will update the quantity
            $this->cartItems = Cart::instance($instance)->content();
            $this->subtotal = Cart::instance($instance)->subtotal();
            $this->alert('success', 'One ' . $cart->name . ' added to ' . $instance . ' cart...');
        }
    }

    public function updateCartMinus(string $id, string $instance, int $quantity = 1)
    {
        $quantity--;
        if ($quantity >= 1) {
            $cart = Cart::instance($instance)->update($id, $quantity); // Will update the quantity
            $this->cartItems = Cart::instance($instance)->content();
            $this->subtotal = Cart::instance($instance)->subtotal();
            $this->alert('error', 'One ' . $cart->name . ' removed from ' . $instance . ' cart...');
        } else {
            $cart = Cart::instance($instance)->update($id, 1); // Will update the quantity
            $this->cartItems = Cart::instance($instance)->content();
            $this->subtotal = Cart::instance($instance)->subtotal();
            $this->alert('info', 'Click the trash icon to completely remove ' . $cart->name . ' from the ' . $instance . ' cart...');
        }
    }

    public function addCart(string $id, string $instance, int $quantity = 1)
    {
        $product = Product::query()->findOrFail($id);
        if ($instance === 'shopping') {
            $found = false;
            if (count(Cart::instance($instance)->content())) {
                foreach (Cart::instance($instance)->content() as $cart) {
                    if ($cart->model->id === $product->id) {
                        if ($cart->qty >= $product->available_quantity) {
                            $found = true;
                            $this->cartItems = Cart::instance($instance)->content();
                            $this->subtotal = Cart::instance($instance)->subtotal();
                            $this->alert('warning', 'We are sorry that no more stock is available for ' . $product->name);
                            break;
                        }
                    }
                }

                if (!$found) {
                    Cart::instance($instance)->add($product->id, $product->name, $quantity, $product->selling_price)->associate(Product::class);
                    $this->cartItems = Cart::instance($instance)->content();
                    $this->subtotal = Cart::instance($instance)->subtotal();
                    $this->alert('success', $product->name . ' added to ' . $instance . ' cart...');
                }

            } else {
                Cart::instance($instance)->add($product->id, $product->name, $quantity, $product->selling_price)->associate(Product::class);
                $this->cartItems = Cart::instance($instance)->content();
                $this->subtotal = Cart::instance($instance)->subtotal();
                $this->alert('success', $product->name . ' added to ' . $instance . ' cart...');
            }
        } else {
            Cart::instance($instance)->add($product->id, $product->name, $quantity, $product->selling_price)->associate(Product::class);
            $this->cartItems = Cart::instance($instance)->content();
            $this->subtotal = Cart::instance($instance)->subtotal();
            $this->alert('success', $product->name . ' added to ' . $instance . ' cart...');
        }
    }

    public function removeCart(string $id, string $instance)
    {
        $cart = Cart::instance($instance)->get($id);
        Cart::instance($instance)->remove($id);
        $this->cartItems = Cart::instance($instance)->content();
        $this->subtotal = Cart::instance($instance)->subtotal();
        $this->alert('error', $cart->name . ' removed from ' . $instance . ' cart...');
    }

    public function destroyCart(string $instance)
    {
        Cart::instance($instance)->destroy();
        $this->cartItems = Cart::instance($instance)->content();
        $this->subtotal = Cart::instance($instance)->subtotal();
        $this->alert('error', 'You have cleared your ' . $instance . ' cart...');
    }


    public function render()
    {
        return view('livewire.inc.cart-manager', [
            'items' => $this->cartItems,
            'subtotal' => $this->subtotal
        ]);
    }
}
