import React, { Component, Fragment } from 'react';
import Authservice from './Authservice';

export default class Sidebar extends Component {

    constructor( props ) {

        super( props );

        this.state = {
            mo: [],
            ra: [],
            wr: [],
            jet: [],
            latex: [],
            web: []
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
                const latex = response.latex;
                const web = response.web;

                this.setState( { mo, ra, wr, jet, latex, web } );

            }

        })

    }


    render() {

        const { mo, ra, wr, jet, latex, web } = this.state;    
        
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
                                <li> <a className="waves-effect waves-dark" href="/" aria-expanded="false"><span className="hide-menu">Dashboard</span></a></li>
                                
                                <li className="bg-dark mb-0 mt-0"><a className="bg-dark waves-effect waves-dark" href="/production-orders" aria-expanded="false"><span className="hide-menu">Production Orders</span></a>
                                    
                                </li>

                                <li className="mb-0 mt-0"> <a className="bg-dark waves-effect waves-dark" href="/not-invoiced" aria-expanded="false"><span className="hide-menu"></span>Not Invoiced</a>
                                
                                    <ul>

                                        <li> <a className="waves-effect waves-dark" href="/purchase-orders" aria-expanded="false"><span className="hide-menu"></span>Purchase Orders</a></li>

                                        <li> <a className="waves-effect waves-dark" href="/not-entered" aria-expanded="false"><span className="hide-menu"></span>Not Entered</a></li>
                                        
                                    </ul>
                                
                                
                                </li>

                                
                                
                                
                            
                                <li><a className="waves-effect waves-dark" href="/folding-schedule/unscheduled">Converting Unscheduled</a></li>
                                
                                <li><a className="waves-effect waves-dark" href="/jet-schedule/unscheduled">Jet Unscheduled</a></li>

                               
                            
                                <li>
                                   

                                    { ( mo || ra || wr || latex || web ) ?

                                        <ul>
                                            { ra.map( r => {

                                                return (
                                                    <li><a className="waves-effect waves-dark" href={`/folding-schedule/${r.id}`}>{r.machine}</a></li>
                                                )

                                            })}

                                            { web.map( m => {

                                                return (
                                                    <li><a className="waves-effect waves-dark" href={`/folding-schedule/${m.id}`}>{m.machine}</a></li>
                                                )

                                            })}  


                                            { wr.map( r => {

                                                return (
                                                    <li><a className="waves-effect waves-dark" href={`/folding-schedule/${r.id}`}>{r.machine}</a></li>
                                                )

                                            })}

                                            { mo.map( m => {

                                                return (
                                                    <li><a className="waves-effect waves-dark" href={`/folding-schedule/${m.id}`}>{m.machine}</a></li>
                                                )

                                            })}

                                            
                                            

                                            { latex.map( r => {

                                                return (
                                                    <li><a className="waves-effect waves-dark" href={`/folding-schedule/${r.id}`}>{r.machine}</a></li>
                                                )

                                            })}

                                        <li>
                                            <a href="/straightknife" className="waves-effect waves-dark" >Straight Knife</a>                    
                                        </li>

                                        

                                            

                                            { jet.map( r => {

                                                    return (
                                                        <li><a className="waves-effect waves-dark" href={`/folding-schedule/${r.id}`}>{r.machine}</a></li>
                                                    )

                                                })
                                            }

                                        </ul>

                                      : '' 

                                    }
                                    
                                    
                                </li>
                                {/* <li>
                                    <a href="#" className="waves-effect waves-dark" >Jet Schedule</a>

                                    

                                   
                                </li>
                                
                                
                                {/* <li> <a className="waves-effect waves-dark" href="/view-schedules" aria-expanded="false"><i className="fa fa-globe"></i><span className="hide-menu"></span>View Schedules</a> 
                                    
                                </li>*/} 
                                <li>
                                    <a className="waves-effect waves-dark" href="/double-die" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Window Double Die</a>
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/tables/out-diagonals" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Diagonals</a>
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/tables/out-mo-booklet" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>MO Booklet</a>
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/tables/out-mo-catalog" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>MO Catalog</a>
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/tables/out-side-seam" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Side Seam</a>
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/tables/adjustable" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>Adjustable</a>
                                </li>

                                <li>
                                    <a className="waves-effect waves-dark" href="/tables/web-ra" aria-expanded="false"><i className="fa fa-smile-o"></i><span className="hide-menu"></span>WEB-RA</a>
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