<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Statistics</div>

                    <div class="card-body">

                        <form name="form">
                            <div class="form-group">
                                <select class="form-control" name="player">
                                    <option></option>
                                    <option v-for="player in players" 
                                        :value="player.id">
                                        {{player.name}}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary mb-2">Submit filters</button>
                            </div>
                        </form>
                        <table 
                            v-if="items"
                            id="order_table" 
                            class="table table-striped table-bordered table-sm" 
                            cellspacing="0" 
                            width="100%">
                            <thead>
                                <tr>
                                    <th>Player Name</th>
                                    <th>Wins</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{items.name}}</td>
                                    <td>{{items.wins}}</td>
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
        props: ["items", "players"],
        mounted() {
            console.log('Table mounted.')
        }
    }
</script>
