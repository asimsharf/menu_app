import axios from "axios";

export const onFileSelected = ({commit}, event) => {
    let file = event.target.files[0];
    
    let reader = new FileReader();

    if (file.size > 1048770) {
        return;
    } else {
        reader.onload = event => {
            commit('ON_FILE_SELECTED',{file:file, result: event.target.result});
        };
        reader.readAsDataURL(file);
    }
}


export const postCategory = ({ commit }, formData)=>{
    console.log(formData)
    
    axios.post("/api/category", formData)
    .then(res => {
        if (res.data.status == "success") {
            commit('POST_CATEGORIES', res.data.data);
        }
    }).catch(error => console.error(error));
}

//fetch all the categories from the api
export const getCategories = ({ commit }) => {
    axios.get(`/api/category`).then(res => {
        if (res.data.status == "success") {
            commit('SET_CATEGORIES', res.data.data);
        }
    }).catch(error => console.error(error));
}

//fetch single category from the api
export const getCategory = ({ commit }, id) => {
    axios.get(`/api/category${id}`).then(res => {
        if (res.data.status == "success") {
            commit('SET_CATEGORY', res.data.data);
        }
    }).catch(error => console.error(error));
}


//remove category from API
export const deleteCategory = ({commit}, category)=>{
    axios.delete(`/api/category/${category.id}`)
    .then(res => {
        if (res.data.status == "success") {
        commit('DELETE_CATEGORY', category);
        }
    }).catch(error => console.error(error));
}



//fetch all the products from the api
export const getProducts = ({ commit }) => {
    axios.get(`/api/product`).then(res => {
        if (res.data.status == "success") {
            commit('SET_PRODUCTS', res.data.data);
        }
    }).catch(error => console.error(error));
}

//fetch the product by the category
export const getProduct = ({ commit }, id) => {
    axios.get(`/api/product/${id}`).then(res => {
        if (res.data.status == "success") {
            commit('SET_PRODUCT', res.data.data);
        }
    }).catch(error => console.error(error));
}