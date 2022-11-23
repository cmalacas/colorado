import React, { Fragment }  from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router} from 'react-router-dom';

//import { Provider } from 'react-redux';

import App from './App';
import Sidebar from './Sidebar';
import SearchPurchaseOrder from './SearchPurchaseOrder';
import DocumentsTab from './DocumentsTab';
import ContactButton from './ContactButton';

const purchaseOrder = document.getElementById('search-purchase-order');
const app = document.getElementById('app-container');
const documentsTab = document.getElementById('document-list')
const contactButton = document.getElementById('contact-button')

const renderApp = Component => {
    ReactDOM.render(
      <Fragment>
        <Router>
          <Component />
        </Router>
      </Fragment>,
      document.getElementById('app-container')
    );
  };

const renderSidebar = Component => {
    ReactDOM.render(
      <Fragment>
          <Component />
      </Fragment>,
      document.getElementById('left-sidebar')
    );
  };

const renderDocuments = Component => {

  ReactDOM.render(
    <Fragment>
        <Component />
    </Fragment>,
    document.getElementById('document-list')
  );
}

const renderContact = Component => {
  ReactDOM.render(
    <Fragment>
        <Component />
    </Fragment>,
    document.getElementById('contact-button')
  );
}


const searchPurchaseOrder = Component => {
    ReactDOM.render(
      <Fragment>
          <Component />
      </Fragment>,
      document.getElementById('search-purchase-order')
    );
  }; 


  
app ? renderApp(App) : null ;
documentsTab ? renderDocuments(DocumentsTab) : null;
renderSidebar(Sidebar);
purchaseOrder ? searchPurchaseOrder(SearchPurchaseOrder) : null;
contactButton ? renderContact(ContactButton) : null;
