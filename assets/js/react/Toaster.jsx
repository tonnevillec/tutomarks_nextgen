import React from 'react';
import {createRoot} from "react-dom/client";
import {toast, ToastContainer} from "react-toastify";

const Toaster = ({message, label}) => {

    if(label === 'danger'){
        toast.error(message);
    }
    if(label === 'warning'){
        toast.warning(message);
    }
    if(label === 'success'){
        toast.success(message);
    }

    return (
        <>
            <ToastContainer
                position={toast.POSITION.TOP_CENTER}
            />
        </>
    );
};

export default Toaster;

class ToastElement extends HTMLElement {
    connectedCallback () {
        const message = this.dataset.message
        const label = this.dataset.label
        const root = createRoot(this);
        root.render(<Toaster message={message} label={label} />);
    }
}

customElements.define('toast-component', ToastElement);