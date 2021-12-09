import React, { Fragment }  from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router} from 'react-router-dom';

import { Provider } from 'react-redux';

import App from './App';
import Sidebar from './Sidebar';

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
  
renderApp(App);
renderSidebar(Sidebar);
