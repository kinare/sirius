<template>
    <!--top row statistics-->
    <div class="row m-b-lg m-t-lg">
        <div class="col-md-6">
            <!--<div class="profile-image">-->
                <!--<img :src="userDetails.profilePicture " class="img-circle circle-border m-b-md" alt="Profile Picture">-->
            <!--</div>-->
            <div class="profile-info">
                <div class="">
                    <div>
                        <h1 class="no-margins" >
                            {{userDetails.fullName}}
                        </h1>
                        <h4>Registration No. : {{currentUserData.Programme_Student_ID}}</h4>
                        <!--<small>-->
                            <!--Bio:-->
                        <!--</small>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <table class="table table-condensed">
                <tbody>
                <tr>
                    <td>
                        <strong>Email</strong>
                    </td>
                    <td>
                        {{currentUserData.E_mail}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Mobile</strong>
                    </td>
                    <td>
                        {{currentUserData.Mobile_No}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Address</strong>
                    </td>
                    <td>
                        {{currentUserData.Address}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>City</strong>
                    </td>
                    <td>
                        {{currentUserData.City}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Postal Code</strong>
                    </td>
                    <td>
                        {{currentUserData.Post_Code}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "content-wrapper",
        props : [
            'currentUser',
            'currentUserData',
            'swapComponent',
            'getApiPath',
            'APIENDPOINTS',
            'userDetails',
            'isEmptyObject'
        ],
        data : function () {
          return {

          }
        },
        methods : {

        },
        created(){

        },
        mounted(){

        },
        watch : {

        }
    }
</script>

<style scoped>

</style>
