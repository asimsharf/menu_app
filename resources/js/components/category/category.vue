<template>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- ################################ -->
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
                  <div class="form-group col-md-6">
                    <label for="image">Category image</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image" @change="onFileSelected" />
                      <label class="custom-file-label" for="image"></label>
                    </div>
                  </div>

                  <div class="form-group col-md-6">

                    <div class="image_preview" :style="{ 'background-image': `url(${form.image})` }"></div>
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
          <!-- /.card-header -->
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
                <tr v-for="category in categories" :key="category.id">
                  <td>{{ category.id }}</td>
                  <td>{{ category.name.ar }}</td>
                  <td>


                    <!-- <router-link to="/category_product"> -->
                    <span @click="categoryProduct(category)" class="badge bg-success">{{ category.products.length }}
                      Products</span>
                    <!-- </router-link> -->
                  </td>
                  <td><img class="direct-chat-img" :src="category.image" /></td>
                  <td>
                    <span class="badge bg-primary" @click="updateCategory(category.id)">
                      <i class="fas fa-edit"></i>
                    </span>
                    <div style="border-left:1px solid #000;height:15px"></div>
                    <span class="badge bg-danger" @click="deleteCategory(category.id)">
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
    this.getCategory();
  },
  data() {
    return {
      form: {
        en_name: null,
        ar_name: null,
        image: null,
      },
      errors: {},

      categories: [],

    };
  },

  methods: {

    onFileSelected(event) {
      this.form.image = event.target.files[0];
    },

    postCategory() {

      const formData = new FormData();

      formData.append('en_name', this.form.er_name);
      formData.append('ar_name', this.form.ar_name);
      formData.append('image', this.form.image, this.form.image.name);

      axios.post("/api/category", formData)
        .then(res => {
          if (res.data.status == "success") {
            this.getCategory();
          }
        })
        .catch(error => console.error(error));
    },

    getCategory() {
      axios.get("/api/category")
        .then(res => {
          if (res.data.status == "success") {
            this.categories = res.data.data;
          }
        })
        .catch(error => console.error(error));
    },

    deleteCategory(id) {
      axios.delete("/api/category/" + id)
        .then(res => {
          if (res.data.status == "success") {
            this.categories = this.categories.filter((category) => {
              return category.id != id;
            });
            this.getCategory();
          }

        })
        .catch(error => console.error(error));
    },

    updateCategory() {
      let id = this.$route.params.id
      axios.patch('/api/category/' + id, this.form)
        .then(res => {
          console.log(data);
          if (data.status == "success") {
            console.log("Category has been updated Successfully");
          }
        })
        .catch(error => console.error(error));
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
