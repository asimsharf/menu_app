export const ON_FILE_SELECTED= (state,imageFile)=>{
    state.image = imageFile;
    state.image_preview = imageFile.result;
}


export const POST_CATEGORIES= (state, formData)=>{
    console.log(formData);
}

export const SET_CATEGORIES = (state, categories) => {
    state.categories = categories;
}

export const SET_CATEGORY = (state, category) => {
    state.category = category;
}

export const DELETE_CATEGORY = (state, category) => {
    console.log(category)
    state.categories = state.categories.filter(item => {
        return item.id != category.id;
    });
}


export const SET_PRODUCTS = (state, products) => {
    state.products = products;
}

export const SET_PRODUCT = (state, product) => {
    state.product = product;
}
