<template>
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ this.$route.params.ar_name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link to="/category">
                                    <a>Category</a>
                                </router-link>
                            </li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">

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
                                            <label class="custom-file-label" for="image">
                                                {{ form.image.name }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <img :src="image_preview"
                                            style="max-width: 100%;max-height:100%;height: 75px;width: 75px;">

                                    </div>

                                </div>


                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>


                <TableProducts table-name="Products" ref="getProductCall" />

            </div>
        </div>

    </div>
</template>

<script>
import TableProducts from './table_products.vue';

export default {

    components: { TableProducts },

    data() {
        return {
            form: {
                en_name: null,
                ar_name: null,
                ar_description: null,
                en_description: null,
                price: null,
                calories: null,
                image: File,
            },
            image_preview: null,
            errors: {},

            categories: [],

        };
    },

    methods: {

        onFileSelected(event) {
            let file = event.target.files[0];
            let reader = new FileReader();

            this.form.image = file;

            if (file.size > 1048770) {
                return;
            } else {
                reader.onload = event => {
                    this.image_preview = event.target.result
                };
                reader.readAsDataURL(file);
            }

        },

        postProduct() {

            const formData = new FormData();

            formData.append('en_name', this.form.en_name);
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

                        this.$refs.getProductCall.getProduct();

                        Toast.fire({
                            icon: 'success',
                            title: 'Product has been created successfully'
                        })

                    }
                })
                .catch(error => console.error(error)).catch(Toast.fire({
                    icon: 'warning',
                    title: 'Product has not been created successfully'
                }));
        },
    },

};
</script>

<style scoped >
</style>
