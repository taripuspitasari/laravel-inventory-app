@extends('dashboard.layouts.sidebar')
@section('container')
<form class="w-full bg-white p-4 shadow-md rounded-lg" action="/dashboard/purchases" method="post">
    @csrf
    <h3 class="font-bold">INVOICE</h3>
        <div class="space-y-2">
        <div class="grid gap-2 md:grid-cols-2">
            <div>
                <label for="date" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Date</label>
                <input type="date" name="date" id="date" class="{{ $errors->has('date') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('date') }}">
                @error('date')
                <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="invoice_number" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Invoice Number</label>
                <input type="text" name="invoice_number" id="invoice_number" class="{{ $errors->has('invoice_number') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('invoice_number') }}" required>
                @error('invoice_number')
                <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="supplier" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Supplier</label>
                <select id="supplier" name="supplier_id" class="{{ $errors->has('supplier_id') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 " required value="{{ old('supplier') }}">
                @foreach ($suppliers as $supplier)
                @if (old('supplier_id') == $supplier->id)
                <option value="{{ $supplier->id }}" selected>{{ $supplier->name }}</option>
                @else
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endif
                @endforeach
                </select>
                @error('supplier_id')
                <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="notes" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Notes/Terms</label>
                <input type="text" id="notes" name="notes" class="{{ $errors->has('notes') ? 'border-red-500' : 'border-gray-300' }} bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Enter notes or terms of services" {{ old('notes') }}/>
                @error('notes')
                <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div x-data="{
            items: [{ item_id: '', quantity: 1, price: 0 }],
            taxRate: 11,
            get subtotal(){
                return this.items.reduce((sum, item) => sum + (item.quantity * item.price || 0), 0);
            },
            get tax() {
                return this.subtotal * (this.taxRate / 100);
            },
            get total () {
                return this.subtotal + this.tax;
            },
            addItem() {
                this.items.push({ item_id: '', quantity: 1, price: 0 });
            },
            removeItem(index) {
                this.items.splice(index, 1);
            }
        }" class="flex items-end gap-2 overflow-x-auto overflow-hidden rounded-lg border border-gray-300">
        <table class="bg-white w-full border-collapse text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-center font-normal text-black dark:bg-gray-700 dark:text-gray-400">
                <tr class="bg-gray-100">
                    <th class="px-4 py-3"></th>
                    <th class="px-4 py-3">Products</th>
                    <th class="px-4 py-3">Qty</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="sr-only">Action</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(item, index) in items" :key="index">
                    <tr class="border border-gray-300">
                        <td class="px-4 py-3 border border-l-gray-200" x-text="index + 1"></td>
                        <td class="border border-gray-300">
                            <select x-model="item.item_id" :name="`items[${index}][item_id]`" class="w-full border-0">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border border-gray-300 text-right">
                            <input type="number" x-model="item.quantity" :name="`items[${index}][quantity]`" class="border-0 text-right w-full" min="1" required />
                        </td>
                        <td class="border border-gray-300 text-right">
                            <div class="flex items-center">
                                <span class="px-2">Rp.</span>
                                <input type="number" x-model="item.price" :name="`items[${index}][price]`" class="border-0 text-right w-full" min="0" required />
                            </div>
                        </td>
                        <td class="border border-gray-300 text-right">
                            <p x-text="`Rp. ${(item.quantity * item.price || 0).toLocaleString()}`" class="px-5 w-full"></p>
                        </td> 
                        <td class="border border-gray-300 text-center">
                            <button type="button" @click="removeItem(index)" class="p-2">
                                <svg class="w-6 h-6 text-gray-800 hover:text-primary-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                </svg>
                            </button>
                        </td>    
                    </tr> 
                </template>
                <tr class="h-10">
                    <td colspan="6">
                        <button type="button" @click="addItem()" class="w-40 flex gap-2 text-primary-600 hover:text-primary-700 dark:text-white px-2">
                            <svg class="w-5 h-5 text-primary-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <p>Add New Line</p>
                        </button>
                    </td>
                </tr>
                <tr class="border border-gray-300 h-8">
                    <td></td>
                    <td colspan="3">Subtotal</td>
                    <td x-text="`Rp. ${subtotal.toLocaleString()}`" class="text-right px-5"></td>
                    <td></td>
                </tr>
                <tr class="border border-gray-300 h-8">
                    <td></td>
                    <td colspan="3">Tax 11%</td>
                    <td x-text="`Rp. ${tax.toLocaleString()}`" class="text-right px-5"></td>
                    <td></td>
                </tr>
                <tr class="border border-gray-300 h-8 bg-gray-200">
                    <td></td>
                    <td colspan="3" class="font-bold">Total</td>
                    <td x-text="`Rp. ${total.toLocaleString()}`" class="font-bold text-right px-5"></td>
                    <td></td>
                </tr>
            </tbody> 
        </table> 
        </div>
        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create new purchase</button> 
    </div> 
</form>
@endsection