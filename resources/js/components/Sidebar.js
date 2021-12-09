import { times } from 'lodash';
import React, { Component, Fragment } from 'react';
import Authservice from './Authservice';

export default class Sidebar extends Component {

    constructor( props ) {

        super( props );

        this.state = {
            mo: [],
            ra: [],
            wr: [],
            jet: []
        }

    }

    componentDidMount() {

        Authservice.getSidebar( )
        .then( response => {

            if (response.sidebar) {

                const mo = response.mo;
                const ra = response.ra;
                const wr = response.wr;
                const jet = response.jet;

                this.setState( { mo, ra, wr, jet } );

            }

        })

    }


    render() {

        const { mo, ra, wr, jet } = this.state;    
        
        return (

            <Fragment>
                <aside className="left-sidebar">
                    <div className="d-flex no-block nav-text-box align-items-center">
                        <span>
                            <img src="/assets/images/logo-light.png" alt="elegant admin template" className="light-logo" />
                        </span>
                        <a className="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i className="ti-menu"></i></a>
                        <a className="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i className="ti-menu ti-close"></i></a>
                    </div>
    
                    <div className="scroll-sidebar">
                    
                        <nav className="sidebar-nav">
                            <ul id="sidebarnav">
                                <li> <a className="waves-effect waves-dark" href="/" aria-expanded="false"><i className="fa fa-tachometer"></i><span className="hide-menu">Dashboard</span></a></li>
                                <li> <a className="waves-effect waves-dark" href="/production-orders" aria-expanded="false"><i className="fa fa-user-circle-o"></i><span className="hide-menu">Production Orders</span></a></li>
                                <li> <a className="waves-effect waves-dark" href="/purchase-orders" aria-expanded="false"><i className="fa fa-table"></i><span className="hide-menu"></span>Purchase Orders</a></li>
                                <li> <a className="waves-effect waves-dark" href="/not-invoiced" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Not Invoiced</a></li>
                            
                                <li><a className="waves-effect waves-dark" href="/folding-schedule/unscheduled">Converting Unscheduled</a></li>
                                <li><a className="waves-effect waves-dark" href="/jet-schedule/unscheduled">Jet Unscheduled</a></li>
                                {/* <li><a className="waves-effect waves-dark" href="/latex-ps/unscheduled">Latex / PS: Unscheduled</a></li>
                                <li><a className="waves-effect waves-dark" href="/straightknife/unscheduled">Straightknife: Unscheduled</a></li> */}
                            
                                <li>
                                    <a href="/folding-schedule" className="waves-effect waves-dark" >Converting Schedule</a>

                                    { ( mo || ra || wr ) ?

                                        <ul>
                                            { mo.map( m => {

                                                return (
                                                    <li><a className="waves-effect waves-dark" href={`/folding-schedule/${m.id}`}>{m.machine}</a></li>
                                                )

                                            })}

                                            { ra.map( r => {

                                                return (
                                                    <li><a className="waves-effect waves-dark" href={`/folding-schedule/${r.id}`}>{r.machine}</a></li>
                                                )

                                            })}

                                            { wr.map( r => {

                                                return (
                                                <li><a className="waves-effect waves-dark" href={`/folding-schedule/${r.id}`}>{r.machine}</a></li>
                                            )

                                            })}


                                        </ul>

                                      : '' 

                                    }
                                    
                                    {/* <ul>
                                        <li><a className="waves-effect waves-dark" href="/folding-schedule/mo">Folding Schedule MO</a></li>
                                        <li><a className="waves-effect waves-dark" href="/folding-schedule/mow">Folding Schedule MOW</a></li>
                                        <li><a className="waves-effect waves-dark" href="/folding-schedule/ra-1">Folding Schedule RA-1</a></li>
                                        <li><a className="waves-effect waves-dark" href="/folding-schedule/ra-2">Folding Schedule RA-2</a></li>
                                        <li><a className="waves-effect waves-dark" href="/folding-schedule/ra-3">Folding Schedule RA-3</a></li>
                                        <li><a className="waves-effect waves-dark" href="/folding-schedule/so">Folding Schedule SO</a></li>
                                        <li><a className="waves-effect waves-dark" href="/folding-schedule/wr-1">Folding Schedule WR-1</a></li>
                                        <li><a className="waves-effect waves-dark" href="/folding-schedule/wr-2">Folding Schedule WR-2</a></li>                    
                                        <li><a className="waves-effect waves-dark" href="/folding-schedule/wr-3">Folding Schedule WR-3</a></li>
                                    </ul> */} 
                                </li>
                                <li>
                                    <a href="/jet-schedule" className="waves-effect waves-dark" >Jet Schedule</a>

                                    { jet ?

                                        <ul>                                        

                                            { jet.map( r => {

                                                    return (
                                                        <li><a className="waves-effect waves-dark" href={`/folding-schedule/${r.id}`}>{r.machine}</a></li>
                                                    )

                                                })
                                            }

                                        </ul>

                                        : ''

                                    }

                                    {/* <ul>    
                                        <li><a className="waves-effect waves-dark" href="/jet-schedule/3inch1">Jet Schedule 3 inch - 1</a></li>
                                        <li><a className="waves-effect waves-dark" href="/jet-schedule/3inch2">Jet Schedule 3 inch - 2</a></li>
                                        <li><a className="waves-effect waves-dark" href="/jet-schedule/3inch3">Jet Schedule 3 inch - 3</a></li>
                                        <li><a className="waves-effect waves-dark" href="/jet-schedule/3inch4">Jet Schedule 3 inch - 4</a></li>
                                        <li><a className="waves-effect waves-dark" href="/jet-schedule/super-jet">Jet Schedule Super Jet</a></li>
                                    </ul> */ }
                                </li>
                                <li>
                                    <a href="/straightknife" className="waves-effect waves-dark" >Straight Knife: Scheduled</a>                    
                                </li>
                                <li> <a className="waves-effect waves-dark" href="/view-schedules" aria-expanded="false"><i className="fa fa-globe"></i><span className="hide-menu"></span>View Schedules</a>
                                    {/* <ul>       
                                        <li><a className="waves-effect waves-dark" href="/view-schedules/jet" aria-expanded="false">Jet</a>

                                            { 

                                                jet ?

                                                <ul>
                                                    {
                                                        jet.map( j => {

                                                            return <li><a className="waves-effect waves-dark" href={`/view-schedules/jet/${j.id}`} aria-expanded="false">{j.machine}</a></li>

                                                        })
                                                    }
                                                </ul>


                                                : '' 


                                            }

                                            <ul>
                                                <li><a className="waves-effect waves-dark" href="/view-schedules/jet/3in1" aria-expanded="false">3 inch - 1</a></li>
                                                <li><a className="waves-effect waves-dark" href="/view-schedules/jet/3in2" aria-expanded="false">3 inch - 2</a></li>
                                                <li><a className="waves-effect waves-dark" href="/view-schedules/jet/3in3" aria-expanded="false">3 inch - 3</a></li>
                                                <li><a className="waves-effect waves-dark" href="/view-schedules/jet/3in4" aria-expanded="false">3 inch - 4</a></li>
                                                <li><a className="waves-effect waves-dark" href="/view-schedules/jet/super" aria-expanded="false">Super Jet</a></li>
                                            </ul> 
                                        </li>
                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding" aria-expanded="false">Folding</a>
                                            <ul>

                                                { ra ?
                                                    <Fragment>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/ra" aria-expanded="false">Folding RA</a>
                                                            <ul>
                                                                {
                                                                    ra.map( r => {

                                                                        return <li><a className="waves-effect waves-dark" href={`/view-schedules/folding/ra/${r.id}`} aria-expanded="false">{r.machine}</a></li>

                                                                    })
                                                                }
                                                            </ul>
                                                        </li>
                                                    </Fragment>

                                                    : ''
                                            
                                                }

                                                { wr ?
                                                    <Fragment>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/ra" aria-expanded="false">Folding WR</a>
                                                            <ul>
                                                                {
                                                                    wr.map( r => {

                                                                        return <li><a className="waves-effect waves-dark" href={`/view-schedules/folding/wr/${r.id}`} aria-expanded="false">{r.machine}</a></li>

                                                                    })
                                                                }
                                                            </ul>
                                                        </li>
                                                    </Fragment>

                                                    : ''
                                            
                                                }

                                                { mo ?
                                                    <Fragment>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/ra" aria-expanded="false">Folding MOW, MO, Latex/PS</a>
                                                            <ul>
                                                                {
                                                                    mo.map( r => {

                                                                        return <li><a className="waves-effect waves-dark" href={`/view-schedules/folding/mo/${r.id}`} aria-expanded="false">{r.machine}</a></li>

                                                                    })
                                                                }                                                               
                                                            </ul>
                                                        </li>
                                                    </Fragment>

                                                    : ''
                                            
                                                }

                                                {/* <li><a className="waves-effect waves-dark" href="/view-schedules/folding/ra" aria-expanded="false">Folding RA</a>
                                                    <ul>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/ra/1" aria-expanded="false">RA - 1</a></li>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/ra/2" aria-expanded="false">RA - 2</a></li>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/ra/3" aria-expanded="false">RA - 3</a></li>                                        
                                                    </ul>
                                                </li>
                                                <li><a className="waves-effect waves-dark" href="/view-schedules/folding/wr" aria-expanded="false">Folding WR</a>
                                                <ul>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/wr/1" aria-expanded="false">WR - 1</a></li>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/wr/2" aria-expanded="false">WR - 2</a></li>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/wr/3" aria-expanded="false">WR - 3</a></li>                                        
                                                    </ul>
                                                </li>
                                                <li><a className="waves-effect waves-dark" href="/view-schedules/folding/more" aria-expanded="false">Folding: MOW, MO, SO, Latex/PS</a>
                                                    <ul>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/more/mow" aria-expanded="false">MOW</a></li>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/more/mo" aria-expanded="false">MO</a></li>
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/more/so" aria-expanded="false">SO</a></li>                                        
                                                        <li><a className="waves-effect waves-dark" href="/view-schedules/folding/more/latex-ps" aria-expanded="false">Latex/PS</a></li>                                        
                                                    </ul>
                                                </li>
                                            </ul>                                        </li>
                                        <li><a className="waves-effect waves-dark" href="/view-schedules/straight-knife" aria-expanded="false">Straight Knife</a></li>
                                            </ul> */}
                                </li>
                                <li>
                                    <a className="waves-effect waves-dark" href="/double-die" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Window Double Die</a>
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/tables/out-diagonals" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Out Diagonals</a>
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/tables/out-mo-booklet" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Out MO Booklet</a>
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/tables/out-mo-catalog" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Out MO Catalog</a>
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/tables/out-side-seam" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Out Side Seam</a>
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/tables/machines" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Machines</a>                    
                                </li>


                                <li>
                                    <a className="waves-effect waves-dark" href="/tables" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Site Tables</a>
                                    
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/customers-list" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Customers</a>
                                    
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/vendors" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Vendors</a>
                                    
                                </li>
                            </ul>
                        </nav>
                        
                    </div>
                    
                </aside>
            </Fragment>

        )

    }

}