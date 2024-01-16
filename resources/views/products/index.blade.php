<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    @if(session('message'))
        <h6 class="alert alert-success">
            {{ session('message') }}
        </h6>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="p-2 bg-white dark:bg-gray-900">
                        <x-primary-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'create')"
                        >{{ __('Add product') }}</x-primary-button>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Shipping Cost
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $product->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $product->price }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->description }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->shipping_cost }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->product_status }}
                            </td>
                            <td class="px-6 py-4" x-data="deleteProduct()">
                                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500">Edit</a>
                                <button @click="confirmDelete = true" class="text-red-500 ml-2">Delete</button>
                                <div x-show="confirmDelete" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
                                    <div class="bg-white p-5 rounded shadow-lg">
                                        <p>Are you sure you want to delete this product?</p>
                                        <div class="mt-4 flex justify-end">
                                            <button @click="confirmDelete = false" class="bg-gray-500 text-white px-4 py-2 mr-2">Cancel</button>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="post" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-4 py-2">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('products.pdf', $product->id) }}" class="text-green-500 ml-2">Generate PDF</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('products.partials.create-form')


</x-app-layout>

<script>
    function deleteProduct() {
        return {
            confirmDelete: false,
        };
    }

</script>
