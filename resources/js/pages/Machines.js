import React, { Component, Fragment } from 'react';

import {Row, Col, Card, Button, CardBody, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Input, Label} from 'reactstrap';

import { buildTable, Pager } from '../components/Functions';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faTrash, faSave, faBan, faEdit, faPlus } from '@fortawesome/free-solid-svg-icons';

import Authservice from '../components/Authservice';

import Swal from 'sweetalert2';

export default class Machines extends Component {

    constructor( props ) {

        super( props );

        this.state = {
            data: [],
            categories: [],
            page: 1,
            limit: 25
        }

        this.getData = this.getData.bind(this);
        this.pager = this.pager.bind(this);
        this.pagerSelect = this.pagerSelect.bind(this);
        this.save = this.save.bind(this);
        this.delete = this.delete.bind(this);
        this.add = this.add.bind(this);
        this.addCategory = this.addCategory.bind(this);
        this.updateCategory = this.updateCategory.bind(this);
        this.deleteCategory = this.deleteCategory.bind( this );
    }

    addCategory( data ) {

        Authservice.addMachineCategory( data )
        .then( response => {

            if (response.categories) {        
                this.setState( { categories: response.categories } );
            }         

        })

    }

    updateCategory( data ) {

        Authservice.saveMachineCategory( data )
        .then( response => {

            if (response.categories) {        
                this.setState( { categories: response.categories } );
            }         

        })
    }

    deleteCategory( data ) {

        Swal.fire({
            title: 'Are you sure?',
            text: `You want to delete this`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.isConfirmed) {           
                Authservice.deleteMachineCategory( { id: data.id }  )
                .then( response => {
                    if (response.categories) {        
                        this.setState( { categories: response.categories } );
                    }         
                })
            }
        })  

    }

    add( data ) {

        Authservice.addMachine( data )
        .then( response => {

            if (response.machines) {        
                this.setState( { data: response.machines } );
            }         

        })

    }

    delete( data ) {

        Swal.fire({
            title: 'Are you sure?',
            text: `You want to delete this`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.isConfirmed) {           
                Authservice.deleteMachine( { id: data.id }  )
                .then( response => {
                    if (response.machines) {        
                        this.setState( { data: response.machines } );
                    }         
                })
            }
        })  

    }

    save( data ) {

        Authservice.saveMachine( data )
        .then( response => {

            if (response.machines) {

                this.setState( { data: response.machines } );

            }

        })

    }

    pager( page ) {

        this.setState( { page } );

    }

    pagerSelect( e ) {

        this.pager( parseInt( e.target.value ) );

    }

    getData( data ) {

        Authservice.getMachines( data )
        .then( response => {

            if (response.machines) {

                this.setState( { data: response.machines, categories: response.categories } );

            }

        })
    }

    componentDidMount() {

        this.getData();

    }


    render() {

        const columns = [
            {
                dataField: 'index',
                text: '#',

            },
            {
                dataField: 'machine',
                text: 'Machine',

            },
            {
                dataField: 'category_name',
                text: 'Category',

            },
            {
                dataField: 'status_name',
                text: 'Status',

            },
            {
                dataField: 'sort_order',
                text: 'Order',

            },
            {
                dataField: 'actions',
                text: 'Actions',

            },
        ];

        const offset = ( this.state.page - 1 ) * this.state.limit;

        let counter = 0;

        const data = this.state.data.filter( ( d, index ) => {

            if ( counter < this.state.limit && index >= offset) {

                d.index = index + offset + 1;

                counter += 1;

                d.actions = <Fragment>
                                <Edit save={this.save} data={ d } categories={ this.state.categories } />
                                <Button onClick={ () => this.delete(d) } color="danger"><FontAwesomeIcon icon={faTrash} /> </Button>
                            </Fragment>

                return d;

            }

        });

        const table = buildTable(data, columns, false, false, false);

        const pager = Pager( this.state.page, this.state.data.length, this.state.limit, this.pager, this.pagerSelect )

        return (

            <Fragment>
                <div className="row page-titles">
                    <div className="col-md-5 align-self-center">
                        <h4 className="text-themecolor">Machines</h4>
                    </div>
                    <div className="col-md-7 align-self-center text-right">
                        <div className="d-flex justify-content-end align-items-center">
                            <ol className="breadcrumb">
                                <li className="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li className="breadcrumb-item active">Machines</li>
                            </ol>
                        
                        </div>
                    </div>
                </div>

                <Row>
                    <Col>
                    
                        <Card>
                            <CardBody>

                                <Row>
                                    <Col className="text-right">
                                        <Add save={this.add} categories={ this.state.categories } />
                                        <Categories 
                                            add={this.addCategory} 
                                            delete={this.deleteCategory}
                                            update={this.updateCategory} 
                                            categories={ this.state.categories} />
                                    </Col>
                                </Row>

                                { table }
                                { pager }
                            </CardBody>
                        </Card>
                    
                    </Col>
                </Row>

            </Fragment>

        )

    }

}

class Add extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            open: false,

            id: 0,
            machine: '',
            category: 0,
            status: 1,
            sort_order: 0,
            errorMachine: false,
        }        

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.save = this.save.bind(this);
        this.change = this.change.bind(this);
    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value, errorMachine: false  } );

    }

    open( ) {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    save() {

        let valid = true;

        let errorMachine = false;

        const { machine } = this.state;

        if (machine === '') {

            errorMachine = true;
            valid = false;

        }

        if (valid) {

            this.props.save( this.state );
            this.close();

        } else {

            this.setState( { errorMachine } );

        }

    }    

    render() {

        const categories = this.props.categories.map( c => {

            return <option value={c.id}>{c.machine}</option>

        })

        return (

            <Fragment>
                <Button  onClick={this.open} className="mr-1 mb-2" color="primary"><FontAwesomeIcon icon={faPlus} /> Add</Button>
                <Modal className="mw-100 w-50" isOpen={this.state.open} toggle={this.close}>
                    <ModalHeader>   
                        Add New Machine
                    </ModalHeader>
                    <ModalBody>
                        <FormGroup>
                            <Label>Machine</Label>
                            <Input name="machine" value={this.state.machine} onChange={this.change} />
                            { this.state.errorMachine ? <div className="alert alert-danger">This is required</div> : '' }
                        </FormGroup>
                        <FormGroup>
                            <Label>Category</Label>         
                            <Input type="select" name="category" value={this.state.category} onChange={this.change}>
                                <option value={0}>select machine category</option>
                                { categories }
                            </Input>
                        </FormGroup>
                        <FormGroup>
                            <Label>Status</Label>
                            <Input type="select" name="status" value={this.state.status} onChange={this.change}>
                                <option value={1}>Enable</option>
                                <option value={0}>Disable</option>
                            </Input>
                        </FormGroup>     
                        <FormGroup>
                            <Label>Sort Order</Label>
                            <Input type="text" name="sort_order" onChange={ this.change } value={this.state.sort_order} />
                        </FormGroup>                        
                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={this.save} color="success"><FontAwesomeIcon icon={faSave} /> Save</Button>
                        <Button onClick={this.close} color="light"><FontAwesomeIcon icon={faBan} /> Cancel</Button>
                    </ModalFooter>
                </Modal>
            </Fragment>

        )

    }


}

class Edit extends Component {

    constructor( props ) {

        super( props );

        const data = props.data;

        this.state = {

            open: false,

            id: data.id,
            machine: data.machine,
            category: data.category,
            status: data.status,
            errorMachine: false,
            sort_order: data.sort_order
        }        

        this.open = this.open.bind(this);
        this.close = this.close.bind(this);
        this.save = this.save.bind(this);
        this.change = this.change.bind(this);
    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value, errorMachine: false  } );

    }

    open( ) {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    save() {

        let valid = true;

        let errorMachine = false;

        const { machine } = this.state;

        if (machine === '') {

            errorMachine = true;
            valid = false;

        }

        if (valid) {

            this.props.save( this.state );
            this.close();

        } else {

            this.setState( { errorMachine } );

        }

    }

    componentDidUpdate() {

        const data = this.props.data;

        if (data.id !== this.state.id) {

            this.setState( {
                id: data.id,
                machine: data.machine,
                category: data.category,
                status: data.status,       
                sort_order: data.sort_order         
            })

        }

    }

    render() {

        const categories = this.props.categories.map( c => {

            return <option value={c.id}>{c.machine}</option>

        })

        return (

            <Fragment>
                <Button  onClick={this.open} className="mr-1" color="primary"><FontAwesomeIcon icon={faEdit} /></Button>
                <Modal className="mw-100 w-50" isOpen={this.state.open} toggle={this.close}>
                    <ModalHeader>   
                        Edit Machine
                    </ModalHeader>
                    <ModalBody>
                    <FormGroup>
                            <Label>Machine</Label>
                            <Input name="machine" value={this.state.machine} onChange={this.change} />
                            { this.state.errorMachine ? <div className="alert alert-danger">This is required</div> : '' }
                        </FormGroup>
                        <FormGroup>
                            <Label>Category</Label>         
                            <Input type="select" name="category" value={this.state.category} onChange={this.change}>
                                <option value={0}>select machine category</option>
                                { categories }
                            </Input>
                        </FormGroup>
                        <FormGroup>
                            <Label>Status</Label>
                            <Input type="select" name="status" value={this.state.status} onChange={this.change}>
                                <option value={1}>Enable</option>
                                <option value={0}>Disable</option>
                            </Input>
                        </FormGroup>    
                        <FormGroup>
                            <Label>Sort Order</Label>
                            <Input type="text" name="sort_order" onChange={ this.change } value={this.state.sort_order} />
                        </FormGroup>              
                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={this.save} color="success"><FontAwesomeIcon icon={faSave} /> Save</Button>
                        <Button onClick={this.close} color="light"><FontAwesomeIcon icon={faBan} /> Cancel</Button>
                    </ModalFooter>
                </Modal>
            </Fragment>

        )

    }
}

class Categories extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            open: false,

        }


        this.open = this.open.bind(this);
        this.close = this.close.bind(this);

    }

    open( ) {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    render() {

        const columns = [
                        {
                            dataField: 'index',
                            text: '#'
                        },
                        {
                            dataField: 'machine',
                            text: 'Category'
                        },
                        {
                            dataField: '_routing',
                            text: 'Routing'
                        },
                        {
                            dataField: 'actions',
                            text: 'Actions'
                        }
                    ];


        const data = this.props.categories.map( (c, index) => {

            c.index = index + 1;

            c._routing = c.routing === 1 ? 'Yes' : 'No';

            c.actions = <Fragment>
                            <EditCategory category={ c } save={this.props.update} />
                            <Button onClick={ () => this.props.delete( c )} color="danger"><FontAwesomeIcon icon={faTrash} /></Button>
                        </Fragment>

            return c;

        })

        const table = buildTable( data, columns, false, false, false );

        return (            

            <Fragment>
                <Button onClick={ this.open } className="mb-2" color="info">Categories</Button>
                <Modal isOpen={this.state.open} toggle={this.close} className="mw-100 w-50">
                    <ModalHeader>
                        Machine Categories
                    </ModalHeader>
                    <ModalBody>
                        <Row>
                            <Col className="text-right">
                                <AddCategory save={this.props.add} />
                            </Col>
                        </Row>

                        { table }
                    </ModalBody>
                    <ModalFooter>

                    </ModalFooter>
                </Modal>
            </Fragment>

        )

    }

}

class AddCategory extends Component {

    constructor( props ) {

        super( props );

        this.state = {

            open: false,
            machine: '',
            routing: 0,
            errorMachine: false

        }

        this.open = this.open.bind( this );
        this.close = this.close.bind( this );
        this.save = this.save.bind( this );
        this.change = this.change.bind( this );
        
    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value, errorMachine: false } );

    }

    open() {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    save() {

        let valid = true;
        let errorMachine = false;

        const machine = this.state.machine;

        if (machine === '') {

            valid = false;
            errorMachine = true;

        }

        if ( valid ) {

            this.props.save( this.state );
            this.close();

        } else {

            this.setState( { errorMachine } );

        }

    }

    render() {

        return (

            <Fragment>
                <Button onClick={this.open} color="primary" className="mb-2"><FontAwesomeIcon icon={faPlus} /> Add Category</Button>
                <Modal isOpen={this.state.open} toggle={this.close}>
                    <ModalHeader>
                        Add Category
                    </ModalHeader>
                    <ModalBody>
                        <FormGroup>
                            <Label>Category</Label>
                            <Input type="text" name="machine" value={this.state.machine} onChange={this.change} />
                            { this.state.errorMachine ? <div className="alert alert-danger">this is required </div> : '' }
                        </FormGroup>
                        <FormGroup>
                            <Label><Input onClick={ () => this.setState( { routing: this.state.routing === 0 ? 1 : 0 } ) } className="position-relative ml-0 mr-2" type="checkbox" checked={this.state.routing === 1 ? true : false } /> Routing</Label>
                        </FormGroup>
                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={this.save} color="success"><FontAwesomeIcon icon={faSave} /> Save</Button>
                        <Button onClick={this.close} color="light"><FontAwesomeIcon icon={faBan} /> Cancel</Button>
                    </ModalFooter>
                </Modal>
            </Fragment>

        )

    }

}

class EditCategory extends Component {

    constructor( props ) {

        super( props );

        const category = props.category;

        this.state = {

            open: false,
            id: category.id,
            machine: category.machine,
            errorMachine: false,
            routing: category.routing,
        }

        this.open = this.open.bind( this );
        this.close = this.close.bind( this );
        this.save = this.save.bind( this );
        this.change = this.change.bind( this );
        
    }

    change( e ) {

        this.setState( { [e.target.name]: e.target.value, errorMachine: false } );

    }

    open() {

        this.setState( { open: true } );

    }

    close() {

        this.setState( { open: false } );

    }

    save() {

        let valid = true;
        let errorMachine = false;

        const machine = this.state.machine;

        if (machine === '') {

            valid = false;
            errorMachine = true;

        }

        if ( valid ) {

            this.props.save( this.state );
            this.close();

        } else {

            this.setState( { errorMachine } );

        }

    }

    render() {

        return (

            <Fragment>
                <Button onClick={this.open} color="primary" className="mr-1"><FontAwesomeIcon icon={faEdit} /></Button>
                <Modal isOpen={this.state.open} toggle={this.close}>
                    <ModalHeader>
                        Edit Category
                    </ModalHeader>
                    <ModalBody>
                        <FormGroup>
                            <Label>Category</Label>
                            <Input type="text" name="machine" value={this.state.machine} onChange={this.change} />
                            { this.state.errorMachine ? <div className="alert alert-danger">this is required </div> : '' }
                        </FormGroup>
                        <FormGroup>
                            <Label><Input onClick={ () => this.setState( { routing: this.state.routing === 0 ? 1 : 0 } ) } className="position-relative ml-0 mr-2" type="checkbox" checked={this.state.routing === 1 ? true : false } /> Routing</Label>
                        </FormGroup>
                    </ModalBody>
                    <ModalFooter>
                        <Button onClick={this.save} color="success"><FontAwesomeIcon icon={faSave} /> Save</Button>
                        <Button onClick={this.close} color="light"><FontAwesomeIcon icon={faBan} /> Cancel</Button>
                    </ModalFooter>
                </Modal>
            </Fragment>

        )

    }

}