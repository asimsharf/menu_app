<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{this.$route.params.ar_name}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link to="/category">
                                    <a >Category</a>
                                </router-link>
                            </li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- ################################ -->
                <div class="col-md-12">
                    <div class="card card-primary collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Create a new Product here</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <form @submit.prevent="postProduct" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="ar_name">Arabic Name</label>
                                        <input v-model="form.ar_name" type="text" id="ar_name" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="en_name">English Name</label>
                                        <input v-model="form.en_name" type="text" id="en_name" class="form-control" />
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="ar_description">Arabic Description</label>
                                        <input v-model="form.ar_description" type="text" id="ar_description"
                                            class="form-control" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="en_description">English Description</label>
                                        <input v-model="form.en_description" type="text" id="en_description"
                                            class="form-control" />
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="price">Price</label>
                                        <input v-model="form.price" type="text" id="price" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="calories">Calories</label>
                                        <input v-model="form.calories" type="text" id="calories" class="form-control" />
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="image">Product image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image"
                                                @change="onFileSelected" />
                                            <label class="custom-file-label" for="image"></label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">

                                        <div class="image_preview"
                                            :style="{ 'background-image': `url(${form.image})` }"></div>
                                    </div>

                                </div>


                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ################################ -->

                <!-- **************************** -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products table</h3>

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
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Product name</th>
                                    <th>Product Description</th>
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
                    <!-- /.card-body -->
                </div>
                <!-- **************************** -->
            </div>
        </div>
        <!-- /.content -->
    </div>
</template>

<script>

export default {
    created() {
       
        this.getProduct();
    },
    data() {
        return {
            form: {
                en_name: null,
                ar_name: null,
                ar_description: null,
                en_description: null,
                price: null,
                calories: null,
                image: null,
            },
            errors: {},

            products: [],
            categories: [],

        };
    },

    methods: {

        onFileSelected(event) {
            this.form.image = event.target.files[0];
        },

        postProduct() {

            const formData = new FormData();

            formData.append('en_name', this.form.er_name);
            formData.append('ar_name', this.form.ar_name);
            formData.append('ar_description', this.form.ar_description);
            formData.append('en_description', this.form.en_description);
            formData.append('price', this.form.price);
            formData.append('calories', this.form.calories);
            formData.append('image', this.form.image, this.form.image.name);
            formData.append('category_id', this.$route.params.id);

            axios.post("/api/product", formData)
                .then(res => {
                    if (res.data.status == "success") {
                        this.getProduct();
                    }
                })
                .catch(error => console.error(error));
        },

        getProduct() {

            axios.get("/api/category_product/" + this.$route.params.id)
                .then(res => {
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
                    }

                })
                .catch(error => console.error(error));
        },

        updateProduct() {
            let id = this.$route.params.id
            axios.patch('/api/product/' + id, this.form)
                .then(res => {
                    console.log(data);
                    if (data.status == "success") {
                        console.log("Product has been updated Successfully");
                    }
                })
                .catch(error => console.error(error));
        },
    },

};
</script>

<style scoped >
.image_preview {
    width: 100px;
    height: 100px;
    display: block;
    cursor: pointer;
    background-size: contain;
    background-position: center center;
}
</style>
