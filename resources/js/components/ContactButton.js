import React, { Component, Fragment } from 'react';
import { BrowserRouter as Router, Switch, Route, withRouter } from "react-router-dom";
import Authservice from './Authservice';

import Contact from '../pages/Contact';

export default class ContactButton extends Component {

  render() {

    return (

      <Router>

          <Switch>

              <Route path="/production-orders/:id/edit" component={Contact} />

          </Switch>

      </Router>                  

    )

  }

}