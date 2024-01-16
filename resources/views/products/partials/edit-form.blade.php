
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Edit
                            </h3>
                        </div>
                        <form class="p-4 md:p-5" action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data" id="productForm">
                            @csrf
                            @method('PATCH')

                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="product_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                    <select id="product_status" name="product_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="active" {{ old('product_status', $product->product_status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('product_status', $product->product_status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('product_status')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write product description here">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="shipping_cost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipping cost</label>
                                    <input type="number" name="shipping_cost" id="shipping_cost" value="{{ old('shipping_cost', $product->shipping_cost) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                                    @error('shipping_cost')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div x-data="imageViewer()" class="col-span-2">
                                    <template x-if="imageUrl || existingImageUrl">
                                        <img :src="imageUrl ? imageUrl : existingImageUrl"
                                             class="object-cover rounded border border-gray-200"
                                             style="width: 100px; height: 100px;"
                                        >
                                    </template>
                                    <template x-if="!imageUrl && !existingImageUrl">
                                        <div
                                            class="border rounded border-gray-200 bg-gray-100"
                                            style="width: 100px; height: 100px;"
                                        ></div>
                                    </template>
                                    <div>
                                        <label for="feature_image" class="block text-gray-700 text-sm font-bold mb-2">Feature Image:</label>
                                        <input type="file" name="feature_image" id="feature_image" accept="image/*" @change="fileChosen" class="py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    @error('feature_image')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Edit product
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function imageViewer() {
        return {
            imageUrl: null,
            existingImageUrl: '{{ route('product.image.show', ['filename' => basename($product->feature_image)]) }}',

            fileChosen(event) {
                const file = event.target.files[0];
                this.imageUrl = URL.createObjectURL(file);
            }
        };
    }
</script>

