<template>
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Programme Registrations</h5>
                        <div class="ibox-tools">
                            <!--<button v-show="!loading" type="button"  class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">-->
                                <!--Make Application <i class="fa fa-plus"></i>-->
                            <!--</button>-->
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div v-if="loading" class="spiner-example">
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                        </div>
                        <div v-else  class="table-responsive">
                            <table class="table table-hover animated fadeIn">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Programme</th>
                                    <th>Intake Year</th>
                                    <th>Stage</th>
                                    <th>Semester</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(programe, index) in programes" >
                                    <td>{{index + 1}}</td>
                                    <td>{{programe.Programme}}</td>
                                    <td>{{programe.Intake_Year}}</td>
                                    <td>{{programe.Intake_Stage}}</td>
                                    <td>{{programe.Intake_Semester}}</td>
                                    <td>{{programe.Date}}</td>
                                    <td>
                                        <button  class="btn btn-sm btn-default" @click="programDetails(programe)">View <i  class="fa fa-eye"></i> </button>
                                        <button class="btn btn-danger btn-sm " @click="timeTable()"><i class="fa fa-file-pdf-o"></i> &nbsp; Timetable</button>
                                        <button class="btn btn-success btn-sm " @click="examResults()"><i class="fa fa-file-pdf-o"></i> &nbsp; Exam Results</button>
                                    </td>
                                </tr>
                                <tr v-if="isEmptyObject(programes)">
                                    <td colspan="8" class="text-center"><i class="text-muted">no programes found</i></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- ==== Modal for application programmes== -->
        <div class="modal inmodal" id="programModal" tabindex="-1" role="dialog" aria-hidden="true"  data-backdrop="false" style="height: auto; z-index: 5000000">
            <div class="modal-dialog modal-md">
                <div class="modal-content animated fadeInDown">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Programme Registration</h4>
                    </div>
                    <div class="modal-body" style="background: white" >
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-condensed table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong class="m-r-sm">Programme</strong>
                                                        {{modal.program.Programme}}
                                                    </td>

                                                    <td>
                                                        <strong class="m-r-sm">Semester</strong>
                                                        {{modal.program.Intake_Semester}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong class="m-r-sm"> Stage</strong>
                                                        {{modal.program.Intake_Stage}}
                                                    </td>

                                                    <td>
                                                        <strong class="m-r-sm">Total Units</strong>
                                                        {{modal.program.Total_Taken_Units}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong class="m-r-sm">Exam Center</strong>
                                                        {{modal.center}}
                                                    </td>

                                                    <td>
                                                        <strong class="m-r-sm">Date</strong>
                                                        {{modal.program.Date}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Units
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">

                                                    <div class="table-responsive">
                                                        <table class="table table-hover animated fadeIn">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Unit</th>
                                                                <th>Description</th>
                                                                <th>Exemption</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr v-for="(units, index) in modal.units" v-if="units.Confirmed" >
                                                                <td>{{index + 1}}</td>
                                                                <td>{{units.Unit}}</td>
                                                                <td>{{units.Remarks}}</td>
                                                                <td><span class="badge badge-danger" v-if="units.Exempted">Exempted</span></td>
                                                            </tr>
                                                            <tr v-if="isEmptyObject(modal.units)">
                                                                <td colspan="8" class="text-center"><i class="text-muted">no programes found</i></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of modal -->
    </div>
</template>

<script>
    export default {
        name: "exams",
        props : [
            'currentUser',
            'currentUserData',
            'swapComponent',
            'getApiPath',
            'APIENDPOINTS',
            'userDetails',
            'isEmptyObject',
            'timeTable',
            'examResults'
        ],
        data : function () {
            return{
                programes : {},
                loading : true,
                modal : {
                    units : {},
                    center : '',
                    program : {}
                }
            }
        },
        methods : {
            // timeTable : function () {
            //     var v = this
            //     var path = v.getApiPath(v.APIENDPOINTS.TIMETABLE, '')
            //
            //     window.open(path, '_blank');
            // },
            getProgrammes : function () {
                var v = this
                var path = v.getApiPath(v.APIENDPOINTS.PROGRAMMES, v.currentUserData.id)

                axios.get(path)
                    .then(function (response) {
                        v.programes = response.data.data
                        v.loading = false
                    })
                    .catch(function (error) {
                        console.log(error)
                        v.loading = false
                    })
            },
            programDetails : function (details) {
                this.modal.program = details
                this.getUnits(details)
                this.getExamCenter(details)
                $('#programModal').modal('toggle')
            },
            getUnits  : function(details){
                var v = this
                var path = v.getApiPath(v.APIENDPOINTS.UNITS,'') + "?Registration_ID=" + details.Registration_ID
                axios.get(path)
                    .then(function (response){
                        v.modal.units = response.data.data
                    })
                    .catch(function (error){
                        console.log(error)
                    })

            },
            getExamCenter  : function(details){
                var v = this
                var path = v.getApiPath(v.APIENDPOINTS.EXAMCENTER,'') + '?Code=' + details.Exam_Center
                axios.get(path)
                    .then(function(response){
                        v.modal.center = response.data.data[0].Name
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            },
        },
        created(){
            this.getProgrammes()
        },
        mounted(){

        },
        watch : {

        }
    }
</script>

<style scoped>

</style>