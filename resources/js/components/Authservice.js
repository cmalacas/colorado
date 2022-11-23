import Axios, { useState, useEffect } from "axios";

class Authservice {

    async getOutDiagonals( data ) {

        try {

            const response = await Axios.post('/get-out-diagonals', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async saveOutDiagonals( data ) {

        try {

            const response = await Axios.post('/save-out-diagonals', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async deleteOutDiagonal( data ) {

        try {

            const response = await Axios.post('/delete-out-diagonal', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async addOutDiagonal( data ) {

        try {

            const response = await Axios.post('/add-out-diagonal', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getOutMoBooklet( data ) {

        try {

            const response = await Axios.post('/get-out-mo-booklet', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async saveOutMoBooklet( data ) {

        try {

            const response = await Axios.post('/save-out-mo-booklet', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async deleteOutMoBooklet( data ) {

        try {

            const response = await Axios.post('/delete-out-mo-booklet', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async addOutMoBooklet( data ) {

        try {

            const response = await Axios.post('/add-out-mo-booklet', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getOutMoCatalog( data ) {

        try {

            const response = await Axios.post('/get-out-mo-catalog', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async saveOutMoCatalog( data ) {

        try {

            const response = await Axios.post('/save-out-mo-catalog', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async deleteOutMoCatalog( data ) {

        try {

            const response = await Axios.post('/delete-out-mo-catalog', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async addOutMoCatalog( data ) {

        try {

            const response = await Axios.post('/add-out-mo-catalog', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getSideSeam( data ) {

        try {

            const response = await Axios.post('/get-side-seam', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async saveSideSeam( data ) {

        try {

            const response = await Axios.post('/save-side-seam', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async deleteSideSeam( data ) {

        try {

            const response = await Axios.post('/delete-side-seam', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async addSideSeam( data ) {

        try {

            const response = await Axios.post('/add-side-seam', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getMachines( data ) {

        try {

            const response = await Axios.post('/tables/get-machines', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async addMachine( data ) {

        try {

            const response = await Axios.post('/tables/add-machine', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async deleteMachine( data ) {

        try {

            const response = await Axios.post('/tables/delete-machine', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async saveMachine( data ) {

        try {

            const response = await Axios.post('/tables/save-machine', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async addMachineCategory( data ) {

        try {

            const response = await Axios.post('/tables/add-machine-category', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async saveMachineCategory( data ) {

        try {

            const response = await Axios.post('/tables/save-machine-category', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async deleteMachineCategory( data ) {

        try {

            const response = await Axios.post('/tables/delete-machine-category', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getSidebar( data ) {

        try {

            const response = await Axios.post('/get-sidebar', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getLocations( data ) {

        try {

            const response = await Axios.post('/tables/get-locations', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async addLocation( data ) {

        try {

            const response = await Axios.post('/tables/add-location', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async saveLocation( data ) {

        try {

            const response = await Axios.post('/tables/save-location', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async deleteLocation( data ) {

        try {

            const response = await Axios.post('/tables/delete-location', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getFoldingUnscheduled( data ) {

        try {

            const response = await Axios.post('/get-folding-unscheduled', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getLatexUnscheduled( data ) {

        try {

            const response = await Axios.post('/get-latex-unscheduled', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getJetUnscheduled( data ) {

        try {

            const response = await Axios.post('/get-jet-unscheduled', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getStraightKnifeUnscheduled( data ) {

        try {

            const response = await Axios.post('/get-straight-knife-unscheduled', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async saveFoldingSchedule( data ) {

        try {

            const response = await Axios.post('/save-folding-schedule', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async saveJetSchedule( data ) {

        try {

            const response = await Axios.post('/save-jet-schedule', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async saveLatexPsSchedule( data ) {

        try {

            const response = await Axios.post('/save-latex-ps-schedule', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async saveStraightKnifeSchedule( data ) {

        try {

            const response = await Axios.post('/save-straight-knife-schedule', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getFoldingScheduleData( data ) {

        try {

            const response = await Axios.post('/get-folding-schedule-data', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getStraightKnifeData( data ) {

        try {

            const response = await Axios.post('/get-straight-knife-data', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getViewSchedulesData( data ) {

        try {

            const response = await Axios.post('/get-view-schedules-data', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async getPurchaseOrdersData( data ) {

        try {

            const response = await Axios.post('/get-purchase-orders-data', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async savePurchaseOrders( data ) {

        console.log('save',data);

        try {

            const response = await Axios.post('/save-purchase-orders', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async updatePurchaseOrders( data ) {

        try {

            const response = await Axios.post('/update-purchase-orders', data )

            return response.data

        } catch ( error ) {

            console.log(error);

        }

    }

    async updateContact( data ) {

        try {

            const response = await Axios.post('/update-contact', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }


    }

    async addContact( data ) {

        try {

            const response = await Axios.post('/add-contact', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }


    }

    async copyPurchaseOrder( data ) {

        try {

            const response = await Axios.post('/copy-purchase-order', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }


    }

    async getCustomers( data ) {

        try {

            const response = await Axios.post('/get-customer-data', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }


    }

    async updateCustomer( data ) {

        try {

            const response = await Axios.post('/update-customer', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }


    }

    async saveCustomer( data ) {

        try {

            const response = await Axios.post('/save-customer', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async updateContacts( data ) {

        try {

            const response = await Axios.post('/update-contact', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async saveContacts( data ) {

        try {

            const response = await Axios.post('/add-contact', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async deleteContacts( data ) {

        try {

            const response = await Axios.post('/delete-contact', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async getVendors( data ) {

        try {

            const response = await Axios.post('/get-vendors', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async updateVendor( data ) {

        try {

            const response = await Axios.post('/update-vendor', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async saveVendor( data ) {

        try {

            const response = await Axios.post('/save-vendor', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async deleteVendor( data ) {

        try {

            const response = await Axios.post('/delete-vendor', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async saveVendorContacts( data ) {

        try {

            const response = await Axios.post('/add-vendor-contact', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async deleteVendorContact( data ) {

        try {

            const response = await Axios.post('/delete-vendor-contact', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async updateVendorContacts( data ) {

        try {

            const response = await Axios.post('/update-vendor-contact', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async deleteVendorContacts( data ) {

        try {

            const response = await Axios.post('/delete-vendor-contact', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async getAdjustable( data ) {

        try {

            const response = await Axios.post('/get-adjustable', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async addAdjustable( data ) {

        try {

            const response = await Axios.post('/add-adjustable', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async saveAdjustable( data ) {

        try {

            const response = await Axios.post('/save-adjustable', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async deleteAdjustable( data ) {

        try {

            const response = await Axios.post('/delete-adjustable', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async getWebRa( data ) {

        try {

            const response = await Axios.post('/get-web-ra', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async addWebRA( data ) {

        try {

            const response = await Axios.post('/add-web-ra', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async saveWebRA( data ) {

        try {

            const response = await Axios.post('/save-web-ra', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async deleteWebRA( data ) {

        try {

            const response = await Axios.post('/delete-web-ra', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async getDocuments( data ) {

        try {

            const response = await Axios.post('/get-documents', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async deleteDocument( data ) {

        try {

            const response = await Axios.post('/delete-document', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async deleteCustomer( data ) {

        try {

            const response = await Axios.post('/delete-customer', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async deletePurchaseOrderDocument( data ) {

        try {

            const response = await Axios.post('/delete-purchase-order-document', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async sendPurchaseOrderEmail( data ) {

        try {

            const response = await Axios.post('/send-purchase-order-email', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

    async getDashboardData( data ) {

        try {

            const response = await Axios.post('/get-dashboard-data', data)

            return response.data

        } catch ( error ) {

            console.log(error);

        }
    }

}

export default new Authservice()