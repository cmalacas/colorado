import React, { Fragment }  from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router} from 'react-router-dom';

//import { Provider } from 'react-redux';

import App from './App';
import Sidebar from './Sidebar';
import SearchPurchaseOrder from './SearchPurchaseOrder';
import DocumentsTab from './DocumentsTab';

const purchaseOrder = document.getElementById('search-purchase-order');
const app = document.getElementById('app-container');
const documentsTab = document.getElementById('document-list')

import configureStore from '../config/configureStore';

import { Provider } from 'react-redux';

const store = configureStore();

const renderApp = Component => {
    ReactDOM.render(
      <Provider store={store}>
        <Router>
          <Component />
        </Router>
      </Provider>,
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
