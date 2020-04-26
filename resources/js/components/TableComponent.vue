<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Table</div>

                    <div class="card-body">

                        <form name="form">
                            <div class="form-group">
                                <select class="form-control" name="client">
                                    <option></option>
                                    <option v-for="client in clients" 
                                        :selected="client.client_id == selectedclient"
                                        :value="client.client_id">
                                        {{client.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="deal">
                                    <option></option>
                                    <option v-for="deal in deals" 
                                        :selected="deal.deal_id == selecteddeal"
                                        :value="deal.deal_id">
                                        {{deal.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary mb-2">Submit filters</button>
                            </div>
                        </form>
                        <table 
                            v-if="items.length"
                            id="order_table" 
                            class="table table-striped table-bordered table-sm" 
                            cellspacing="0" 
                            width="100%">
                            <thead>
                                <tr>
                                    <th>Accepted</th>
                                    <th>Refused</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items">
                                    <td>{{item.accepted}}</td>
                                    <td>{{item.refused}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-else class="alert alert-warning" role="alert">
                          No data
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["items", "clients", "deals", "selectedclient", "selecteddeal"],
        mounted() {
            console.log('Table mounted.')
        }
    }
</script>
