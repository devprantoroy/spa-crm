<template>
<div>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon far fas fa-copy"></i>
        <p>
          Admin Setup
          <i class="fas fa-angle-left right"></i>
          <!-- <span class="badge badge-info right">6</span> -->
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item" v-can="['role_menu']">
          <router-link to="/role" class="nav-link">
            <b-icon icon="person-check-fill" class="far" font-scale="1.2"></b-icon>
            <p> {{ myLang.role_management }}</p>
          </router-link>
        </li>
        <li class="nav-item" v-can="['permission_menu']">
          <router-link to="/permission" class="nav-link">
            <b-icon icon="person-bounding-box" font-scale="1.2"></b-icon>
            <p>{{ myLang.permission_management }}</p>
          </router-link>
        </li>
        <li class="nav-item" v-can="['assign_role_to_user_menu']">
          <router-link to="/assign_role_to_user" class="nav-link">
            <b-icon icon="folder-symlink-fill" font-scale="1.2"></b-icon>
            <p> {{ myLang.assign_role_to_user }}</p>
          </router-link>
        </li>
        <li class="nav-item" v-can="['assign_permission_to_user_menu']">
          <router-link to="/assign_permission_to_user" class="nav-link">
            <b-icon icon="unlock-fill" font-scale="1.2"></b-icon>
            <p> {{ myLang.assign_permission_to_user }}</p>
          </router-link>
        </li>
        <li class="nav-item" v-can="['manage_user_menu']">
          <router-link to="/users" class="nav-link">
            <b-icon icon="person-circle" font-scale="1.2"></b-icon>
            <p> {{ myLang.manage_users }}</p>
          </router-link>
        </li>
      </ul>
    </li>



    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon far fas fa-copy"></i>
        <p>
          Manage Buyer/Seller
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item" >
          <router-link to="/buyer_manage" class="nav-link">
            <b-icon icon="circle" class="far" font-scale="1.2"></b-icon>
            <p> Manage Buyer</p>
          </router-link>
        </li>

        <li class="nav-item" >
          <router-link to="/seller_manage" class="nav-link">
            <b-icon icon="circle" class="far" font-scale="1.2"></b-icon>
            <p> Manage Seller</p>
          </router-link>
        </li>

        <li class="nav-item" >
          <router-link to="/connect_seller_buyer" class="nav-link">
            <b-icon icon="circle" class="far" font-scale="1.2"></b-icon>
            <p> Connect Seller/Buyer</p>
          </router-link>
        </li>

        <li class="nav-item" >
          <router-link to="/data_count" class="nav-link">
            <b-icon icon="circle" class="far" font-scale="1.2"></b-icon>
            <p> Data Count</p>
          </router-link>
        </li>

        <li class="nav-item" >
          <router-link to="/memo_page" class="nav-link">
            <b-icon icon="circle" class="far" font-scale="1.2"></b-icon>
            <p> Memo Page</p>
          </router-link>
        </li>
        <!-- <li class="nav-item" >
          <router-link :to="{name: 'import_seller_buyer'}" class="nav-link">
            <b-icon icon="circle" class="far" font-scale="1.2"></b-icon>
            <p>Import Seller/Buyer</p>
          </router-link>
        </li> -->
      </ul>
    </li>
</div>
</template>
