import React, { Component, Fragment } from 'react';

import { Row, Col, CardHeader, CardBody, Card } from 'reactstrap'
import Authservice from '../components/Authservice';

import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
} from 'chart.js';

import { Bar } from 'react-chartjs-2';


ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend
);

export const options = {
  responsive: true,
  plugins: {
    legend: {
      position: 'top',
    },
    title: {
      display: false,
      text: 'Chart.js Bar Chart',
    },
  },
};

export default class Dashboard extends Component {

  constructor( props ) {

    super( props );

    this.state = {
      weeks: [],
      envelopes: [],
      sales: [],
      completed: [],
      thisWeek: []
    }

    this.getData = this.getData.bind(this);

  }

  getData() {

    Authservice.getDashboardData()
    .then( response => {

      if ( response.envelopes ) {

        const weeks = response.weeks;
        const envelopes = response.envelopes;
        const sales = response.sales;
        const completed = response.completed;
        const thisWeek = response.completedThisWeek;

        this.setState( { weeks, envelopes, sales, completed, thisWeek });

      }

    })

  }

  componentDidMount() {

    this.getData();

  }

  render() {

    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov', 'Dec'];

    const values = [];
    const saleValues = [];
    const completedValue = [];

    labels.map( m => {

      const env = this.state.envelopes.filter( e => e.month == m )

      const sls = this.state.sales.filter( e => e.month == m )

      const completed = this.state.completed.filter( e => e.month == m)

      if ( env.length > 0 ) {

        values.push( env[0].quantity )

      } else {

        values.push(0)

      }

      if ( sls.length > 0 ) {

        saleValues.push( sls[0].amount )

      } else {

        saleValues.push( 0 )

      }

      if ( completed.length > 0 ) {

        completedValue.push( completed[0].quantity )

      } else {

        completedValue.push( 0 )

      }

    } );

    

    const data = {
      labels,
      datasets: [
        {
          label: 'In Progress',
          data: values,
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
        },
        {
          label: 'Completed',
          data: completedValue,
          backgroundColor: 'rgba(53, 162, 235, 0.5)',
        },
      ],
    };   

    const sales = {
      labels,
      datasets: [
        {
          label: 'Total Sales',
          data: saleValues,
          backgroundColor: 'rgba(53, 162, 235, 0.5)',
        },
      ],
    };

    const weeks = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

    const weekValues = [];
    const thisWeekValues = [];

    weeks.map( day => {

      const wks = this.state.weeks.filter( w2 => w2.day == day )

      const complete = this.state.thisWeek.filter( c => c.day == day );

      if ( wks.length > 0 ) {

        weekValues.push( wks[0].quantity )

      } else {

        weekValues.push( 0 );

      }

      if ( complete.length > 0 ) {

        thisWeekValues.push( complete[0].quantity )

      } else {

        thisWeekValues.push( 0 );

      }

    });

    const weekData = {
      labels: weeks,
      datasets: [
        {
          label: 'In Progress',
          data: weekValues,
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
        },
        {
          label: 'Completed',
          data: thisWeekValues,
          backgroundColor: 'rgba(53, 162, 235, 0.5)',
        },
      ],
    };

    return (

      <Fragment>

          <div className="row page-titles">
              <div className="col-md-5 align-self-center">
                  <h4 className="text-themecolor">Dashboard</h4>
              </div>
          </div>

          <Row>

            <Col md={6}>

              <Card>
               
                <CardBody>

                <CardHeader>Monthly Total Envelope</CardHeader>

                <Bar options={options} data={data} />

                </CardBody>
              </Card>
              
            
            </Col>

            <Col md={6}>

              <Card>
                
              
                <CardBody>

                  <CardHeader>Gross Sales</CardHeader>

                  <Bar options={options} data={sales} />

                  
                </CardBody>

              </Card>
            
            </Col>

          </Row>

          <Row>

            <Col>

              <Card>
                

                <CardBody>

                  <CardHeader>This Week</CardHeader>

                  <Bar options={options} data={weekData} />

                </CardBody>
              
              </Card>
              
            
            </Col>

           

          </Row>


      </Fragment>

    )

  }

}
