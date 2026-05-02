import React, { Component, Fragment } from 'react';
import { BrowserRouter as Router, Switch, Route, withRouter } from "react-router-dom";
import Authservice from './Authservice';

import SalesReps from '../pages/SalesReps';

export default class SalesRepButton extends Component {

  render() {

    return (

      <Router>

          <Switch>

              <Route path="/production-orders/:id/edit" component={SalesReps} />

          </Switch>

      </Router>                  

    )

  }

}