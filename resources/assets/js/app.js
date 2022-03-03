
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

require('chart.js');
// vue-charts package
require('hchs-vue-charts');
Vue.use(VueCharts);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this applications
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('side-nav-header', require('./components/dashboard/side-nav-header.vue'));
Vue.component('dashboard', require('./components/dashboard/dashboard.vue'));
Vue.component('exams', require('./components/dashboard/exams'));
Vue.component('faq', require('./components/dashboard/faq'));
Vue.component('wave-loader', require('./components/dashboard/utilities/wave-loader'));
Vue.component('notification', require('./components/dashboard/utilities/notification'));
Vue.component('search-results', require('./components/dashboard/search-results'));

//Global Filter
Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1).toLowerCase()
});

const app = new Vue({
    el: '#app',
    data: {
        pageLoading : true,
        fromNotification : '',
        openModal : false,
        currentComponent: 'dashboard',
        profPic : '',
        currentUser                         : {},
        currentUserData                     : {},
        userDetails   : {
            fullName        : '',
            profilePicture  : '',
            id              : ''
        },
        currentEmployeeLeaveApplications    : {},
        currentEmployeeLeaveAllocations     : {},
        APIENDPOINTS     : {
            CURRENTUSER                             : 'api/users/current',                   // Current logged in user
            CURRRENTSTUDENT                         : 'api/students',
            NOTIFICATIONS                           : 'api/users/notification/unread',
            READNOTIFICATIONS                       : 'api/users/notification/markasread',
            PROGRAMMES                              : 'api/students@students_programmes',
            UNITS                                   : 'api/students_units',
            EXAMCENTER                              : 'api/exam_centers',
            TIMETABLE                               : 'api/students/timetable',
            EXAMRESULTS                             : 'api/students/exam_results'
            //http://localhost:8000/api/exam_centers?Code=0001

            },
        searchResults : '',
        searchTerm : '',
        notificationsData : {}
    },
    methods : {
        isEmptyObject : function (object) {
            return (Object.keys(object).length === 0)
        },
        fullNames : function(nameOne, nameTwo, nameThree){
            nameOne     = nameOne === null ? '' : nameOne.trim()
            // nameTwo     = nameTwo === null? '' : nameTwo.trim()
            nameThree   = nameThree === null ? '' : nameThree.trim()
            return nameOne + /*' ' + nameTwo +*/ ' ' + nameThree
        },
        swapComponent: function (component) {

            if (component === 'new-leave'){
                this.openModal = true
                this.currentComponent = 'open-applications'
            }else if(component === 'approval-notice'){

            }else {
                this.openModal = false
                if (Vue.options.components[component]) {
                    this.currentComponent = component
                } else {
                    alert(component + ' component not found');
                }
            }
        },
        validateField : function (field) {
          return field.length !== 0
        },
        sanitizeHeaders: function (heading) {
            return heading.replace('-', ' ');
        },
        getApiPath: function (rawPath, data) {
            if (data.length === 0) {
                return rawPath.replace('@', '/')
            } else {
                return  rawPath.substr(rawPath.length - 1) === '@' ? rawPath.replace('@', '/' + data) : rawPath.replace('@', '/' + data + '/') ;
            }
        },
        setUserDetails : function () {
            this.userDetails.fullName =  this.currentUserData.Other_Names //this.usthis.fullNames(this.currentUserData.First_Name, this.currentUserData.Middle_Name, this.currentUserData.Last_Name)
            // this.userDetails.fullName = this.currentUserData.First_Name == null ? "": this.currentUserData.First_Name  +' '+ this.currentUserData.Middle_Name +' '+ this.currentUserData.Last_Name
           // this.userDetails.profilePicture = this.getApiPath(this.APIENDPOINTS.PROFILEPICTURE, this.currentUserData.id)
            this.userDetails.id = this.currentUser.id
        },
        timeTable : function () {
            let v = this
            let path = v.getApiPath(v.APIENDPOINTS.TIMETABLE, '')

            window.open(path, '_blank');
        },
        examResults : function () {
            let v = this
            let path = v.getApiPath(v.APIENDPOINTS.EXAMRESULTS, '')
            window.open(path, '_blank');
        },
        getData : function () {
            let v = this
            axios.get(v.getApiPath(v.APIENDPOINTS.CURRENTUSER,''))
                .then(function (response) {
                    v.currentUser = response.data
                    v.getUserData(v.currentUser.id);
                    v.pageLoading = false
                })
                .catch(function (error) {
                    console.log(error)
                })
        },
        getUserData : function(id){
            // console.log(v.getApiPath(v.APIENDPOINTS.CURRRENTSTUDENT,'?user_id=' + v.currentUser.id))
            let v = this
            axios.get(v.APIENDPOINTS.CURRRENTSTUDENT + '?user_id=' + id)    
                .then(function (response) {
                    v.currentUserData = response.data.data[0]
                    v.setUserDetails()
                })
                .catch(function (error) {
                    console.log("Error encountered while fetching current Student data.");
                    console.log(error);
                })
        },
        search : _.debounce(
            function () {
                this.searchResults = 'Searching...'
                let v = this
                axios.get(v.APIENDPOINTS.SEARCH)
                    .then(function (response) {
                        v.searchResults = response.data
                    })
                    .catch(function (error) {
                        v.searchResults = 'Nothing Found'
                    })
            },
            500
        ),
        notificationEvents : function (data) {
            // expects an object
            // data {
            //     component : '',
            //     id of entry : ''
            // }
            this.notificationsData = data
            this.swapComponent(data.component)
        },
    },
    created : function () {
        this.getData();
    },
    watch : {
        searchTerm : function () {
            this.swapComponent('search-results')
            this.searchResults  = ' Typing..'
            this.search();
        },
    }

});
