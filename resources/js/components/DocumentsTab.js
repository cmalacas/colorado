import React, { Component, Fragment } from 'react';
import { BrowserRouter as Router, Switch, Route, withRouter } from "react-router-dom";
import Authservice from './Authservice';

import Documents from '../pages/Documents';

export default class DocumentsTab extends Component {

  render() {

    return (

      <Router>

          <Switch>

              <Route path="/production-orders/:id/edit" component={Documents} />

          </Switch>

      </Router>

                  

    )

  }

}