<template>
  <el-menu
    class="header"
    mode="horizontal"
    :ellipsis="false"
  >
    <el-menu-item index="0">
      <router-link to="/">
        <el-image src="assets/images/logo.png" />
      </router-link>
    </el-menu-item>

    <el-sub-menu index="1">
      <template #title>Pages</template>
      <el-menu-item index="1-2">
        <router-link to="/cats">Cats List</router-link>
      </el-menu-item>
      <el-menu-item index="1-3">
        <router-link to="/breeds">Breeds List</router-link>
      </el-menu-item>
      <el-menu-item index="1-4">
        <router-link to="/editCat/0">Add a Cat</router-link>
      </el-menu-item>
      <el-menu-item index="1-5">
        <router-link to="/editBreed/0">Add a Breed</router-link>
      </el-menu-item>
    </el-sub-menu>


  </el-menu>
</template>

<script>
export default {
  name: "NavbarComponent"
}
</script>

<style scoped>

</style>
