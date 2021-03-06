<div class="wrapper wrapper-content">
    <keep-alive exclude="open-applications">
            <component :is="currentComponent"
                       class="animated fadeInRight"
                       :current-user="currentUser"
                       :current-user-data="currentUserData"
                       :swap-component="swapComponent"
                       :search-results="searchResults"
                       :search-term="searchTerm"
                       :user-details="userDetails"
                       :a-p-i-e-n-d-p-o-i-n-t-s="APIENDPOINTS"
                       :get-api-path="getApiPath"
                       :is-empty-object="isEmptyObject"
                       :validate-field="'validateField'"
                       :full-names="fullNames"
                       :open-modal="openModal"
                       :notifications-data="notificationsData"
                       :notification-events="notificationEvents"
                       :page-loading="pageLoading"
                       :time-table="timeTable"
                       :exam-results="examResults"
            ></component>
    </keep-alive>
</div>

