<template>
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Categories Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                            <h3 class="card-title">Create a new Category here</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            <form @submit.prevent="postCategory" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="ar_name">Arabic Name</label>
                                        <input v-model="form.ar_name" type="text" id="ar_name" class="form-control" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="en_name">English Name</label>
                                        <input v-model="form.en_name" type="text" id="en_name" class="form-control" />
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label for="image">Product image</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image"
                                                    @change="onFileSelected" />
                                                <label class="custom-file-label" for="image">
                                                    {{ form.image.name }}
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">

                                            <img :src="imagePreview"
                                                style="max-width: 100%;max-height:100%;height: 75px;width: 75px;">

                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories table</h3>

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
                                    <th>Category name</th>

                                    <th style="width: 20%">Product No</th>
                                    <th style="width: 80px">Image</th>
                                    <th style="width: 80px">#</th>
                                </tr>
                            </thead>

                            <tbody>
                                <div v-if="isLoading" class="loader"></div>
                                <tr v-if="!isLoading" v-for="category in categories" :key="category.id">
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.name.ar }}</td>
                                    <td>
                                        <span @click="categoryProduct(category)" class="badge bg-success">{{
                                                category.products.length
                                        }}
                                            Products</span>
                                    </td>
                                    <td><img class="direct-chat-img" :src="category.image" /></td>
                                    <td>
                                        <span @click="setCategory(category)" class="badge bg-primary"
                                            data-toggle="modal" data-target="#modal-category">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <div style="border-left:1px solid #000;height:15px"></div>
                                        <span class="badge bg-danger" @click="deleteCategory(category)">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade show" id="modal-category" style="display: none; padding-right: 15px;" aria-modal="true"
            role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateCategory()" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="ar_name">Arabic Name </label>
                                    <input v-model="form.ar_name" type="text" id="ar_name" class="form-control" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="en_name">English Name</label>
                                    <input v-model="form.en_name" type="text" id="en_name" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="image">Category image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image"
                                            @change="onFileSelected" />
                                        <label class="custom-file-label" for="image">
                                            {{ imageFile.name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img :src="imagePreview"
                                        style="max-width: 100%;max-height:100%;height:100px;width: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    computed:{
        categories(){
            return this.$store.state.categories;
        },

        category(){
            return this.$store.state.category;
        },

        imagePreview(){
            return this.$store.state.image_preview;
        },

        imageFile(){
            return this.$store.state.image;
        }
    },

    mounted(){
        this.$store.dispatch('getCategories');
        this.$store.dispatch('getCategory', this.category_id);
    },

    data() {
        return {
            form: {
                en_name: null,
                ar_name: null,
                image: File,
            },
           
            errors: {},
            categoryID: null,
            isLoading: false,

        };
    },

    methods: {
        deleteCategory(category){
            this.$store.dispatch('deleteCategory', category);
        },

        onFileSelected(event) {
           this.$store.dispatch('onFileSelected', event);
        },
        
        postCategory() {
            const formData = new FormData();
            formData.append('en_name', this.form.en_name);
            formData.append('ar_name', this.form.ar_name);
            formData.append('image', this.imageFile, this.imageFile.name);
            console.log(formData)

            this.$store.dispatch('postCategory',formData );

            
        },

        setCategory(category) {
            this.categoryID = category.id;
            this.form.ar_name = category.name.ar;
            this.form.en_name = category.name.en;
            this.image_preview = category.image;
        },


        updateCategory() {

            const formData = new FormData();

            formData.append('en_name', this.form.en_name);
            formData.append('ar_name', this.form.ar_name);
            formData.append('image', this.form.image, this.form.image.name);

            axios.post('/api/category/' + this.categoryID, formData)
                .then(res => {
                    if (res.data.status == "success") {
                        this.$store.dispatch('getCategories');
                        Toast.fire({
                            icon: 'success',
                            title: 'Category has been updated successfully'
                        })
                    }
                })
                .catch(error => console.error(error)).catch(Toast.fire({
                    icon: 'warning',
                    title: 'Category has not been created successfully'
                }));
        },

        categoryProduct(category) {
            this.$router.push({
                name: 'category_product',
                params: { id: category.id, ar_name: category.name.ar, en_name: category.name.en },
            });
        }

    },

};
</script>
<style  scoped>
.loader {
    border: 16px solid #f3f3f3;
    border-top: 16px solid #3498db;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
