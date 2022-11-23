import React, { Component } from 'react';
import { BrowserRouter as Router, Switch, Route, withRouter } from "react-router-dom";

import OutDiagonals from '../pages/OutDiagonals';
import OutMoBooklet from '../pages/OutMoBooklet';
import OutMoCatalog from '../pages/OutMoCatalog';
import OutSideSeam from '../pages/OutSideSeam';
import Machines from '../pages/Machines';
import Locations from '../pages/Locations';
import FoldingUnscheduled from '../pages/FoldingUnscheduled';
import LatexUnscheduled from '../pages/LatexUnscheduled';
import JetUnscheduled from '../pages/JetUnscheduled';
import StraightKnifeUnscheduled from '../pages/StraightKnifeUnscheduled';
import FoldingSchedule from '../pages/FoldingSchedule';
import StraightKnife from '../pages/StraightKnife';
import ViewSchedules from '../pages/ViewSchedules';
import OpenSchedule from '../pages/OpenSchedule';
import PurchaseOrders from '../pages/PurchaseOrders';
import PurchaseOrdersEdit from '../pages/PurchaseOrdersEdit';
import Customers from '../pages/Customers';
import Vendors from '../pages/Vendors';
import Adjustable from '../pages/Adjustable';
import WebRa from '../pages/WebRa';
import Dashboard from '../pages/Dashboard';

export default class App extends Component {

    render() {

        return (

            <Router>

                <Switch>

                    <Route path="/" exact component={Dashboard} />
                    <Route path="/home" exact component={Dashboard} />

                    <Route path="/tables/out-diagonals" component={OutDiagonals} />
                    <Route path="/tables/out-mo-booklet" component={OutMoBooklet} />
                    <Route path="/tables/out-mo-catalog" component={OutMoCatalog} />
                    <Route path="/tables/out-side-seam" component={OutSideSeam} />
                    <Route path="/tables/machines" component={Machines} />
                    <Route path="/tables/locations" component={Locations} />

                    <Route path="/folding-schedule/unscheduled" component={FoldingUnscheduled} />
                    <Route path="/latex-ps/unscheduled" component={LatexUnscheduled} />
                    <Route path="/jet-schedule/unscheduled" component={JetUnscheduled} />
                    <Route path="/straightknife/unscheduled" component={StraightKnifeUnscheduled} />

                    <Route path="/folding-schedule/:id" component={FoldingSchedule} />
                    <Route path="/straightknife" component={StraightKnife} />

                    <Route path="/view-schedules" component={ViewSchedules} />

                    <Route path="/open-schedule/:id" component={OpenSchedule} />

                    <Route path="/purchase-orders/create" component={PurchaseOrders} />

                    <Route path="/purchase-orders/:id/edit" component={PurchaseOrdersEdit} />

                    <Route path="/customers-list" component={Customers} />

                    <Route path="/vendors" component={Vendors} />

                    <Route path="/tables/adjustable" component={Adjustable} />
                    <Route path="/tables/web-ra" component={WebRa} />

                </Switch>
                

            </Router>

        )

    }

}