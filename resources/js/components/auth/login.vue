<template>
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>MENU</b>APP</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">تسجيل الدخول لبدء الجلسة الخاصة بك</p>
                <form @submit.prevent="postLogin" >
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">دخول</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data(){
        return {}
    },
    methods:{
        postLogin(){
          this.$router.push({path: '/admin'});
        }
    }
}
</script>
