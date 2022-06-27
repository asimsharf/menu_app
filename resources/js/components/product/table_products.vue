<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ tableName }} table</h3>

            <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 50%">Product name</th>
                        <th>Description</th>
                        <th style="width: 20%">Price</th>
                        <th style="width: 20%">Calories</th>
                        <th style="width: 20%">Category</th>
                        <th style="width: 80px">Image</th>
                        <th style="width: 80px">#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.id }}</td>
                        <td>{{ product.name.ar }}</td>
                        <td>{{ product.description.ar }}</td>
                        <td>{{ product.price }} S.R</td>
                        <td>{{ product.calories }} kcl</td>
                        <td>
                            <span class="badge bg-success">{{ product.category.name.en }} </span>
                        </td>
                        <td><img class="direct-chat-img" :src="product.image" /></td>
                        <td>
                            <span class="badge bg-primary" @click="updateProduct(product.id)">
                                <i class="fas fa-edit"></i>
                            </span>
                            <div style="border-left:1px solid #000;height:15px"></div>
                            <span class="badge bg-danger" @click="deleteProduct(product.id)">
                                <i class="fas fa-trash"></i>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        tableName: {
            type: String,
            required: true,
        }
    },

    created() {
        this.getProduct();
    },

    data() {
        return {
            products: [],
        }
    },

    methods: {

        getProduct() {

            axios.get("/api/product").then(res => {
                if (res.data.status == "success") {
                    this.products = res.data.data;
                }
            })
                .catch(error => console.error(error));
        },

        deleteProduct(id) {
            axios.delete("/api/product/" + id)
                .then(res => {
                    if (res.data.status == "success") {
                        this.products = this.products.filter((product) => {
                            return product.id != id;
                        });
                        this.getProduct();
                        Toast.fire({
                            icon: 'success',
                            title: 'Product has been removed successfully'
                        })
                    }

                })
                .catch(error => console.error(error)).catch(Toast.fire({
                    icon: 'warning',
                    title: 'Product has not been removed successfully'
                }));
        },

        updateProduct(id) {

            const formData = new FormData();

            formData.append('en_name', this.form.en_name);
            formData.append('ar_name', this.form.ar_name);
            formData.append('ar_description', this.form.ar_description);
            formData.append('en_description', this.form.en_description);
            formData.append('price', this.form.price);
            formData.append('calories', this.form.calories);
            formData.append('image', this.form.image, this.form.image.name);
            formData.append('category_id', this.form.category_id);

            axios.patch('/api/product/' + id, formData)
                .then(res => {
                    if (res.data.status == "success") {
                        Toast.fire({
                            icon: 'success',
                            title: 'Product has been updated successfully'
                        })
                    }
                })
                .catch(error => console.error(error)).catch(Toast.fire({
                    icon: 'warning',
                    title: 'Product has not been created successfully'
                }));
        },

    }
}

</script>
