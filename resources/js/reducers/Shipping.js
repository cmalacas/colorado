const initialState = {
    shipping: []
}

const SET_SHIPPING_DATA = 'SET_SHIPPING_DATA';
const GET_SHIPPING_DATA = 'GET_SHIPPING_DATA';

export default function reducer( state = initialState, action) {

    switch (action.type) {

        case SET_SHIPPING_DATA:

            const shipping = action.payload;    

            return {
                ...state,
                shipping
            }        

        default: 

            return state;

    }
    
}

export const setShippingData = (data) => {

    console.log('set', data.length);

    return {
        type: SET_SHIPPING_DATA,
        payload: data
    }

}

export const getShippingData = () => {

    return {
        type: GET_SHIPPING_DATA
    }

}
