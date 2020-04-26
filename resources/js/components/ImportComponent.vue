<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Hands Import</div>

                    <div class="card-body">
                        <form name="form" method="post" enctype="multipart/form-data">
                            <input type="file" name="hands" @change="uploadReady = true">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group text-right">
                                <button v-if="uploadReady" type="submit" class="btn btn-primary mb-2">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                uploadReady: false
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
