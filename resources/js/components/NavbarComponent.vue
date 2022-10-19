<template>
  <el-menu
    class="el-menu-demo"
    mode="horizontal"
    :ellipsis="false"
  >
    <el-menu-item index="0">
      <router-link to="/">
        <el-image src="assets/images/logo.png" />
      </router-link>
    </el-menu-item>

    <el-sub-menu index="1">
      <template #title>Разделы</template>
      <el-menu-item index="1-2">
        <router-link to="/cats">Список кошек</router-link>
      </el-menu-item>
      <el-menu-item index="1-3">
        <router-link to="/breeds">Список пород</router-link>
      </el-menu-item>
      <el-menu-item index="1-4">
        <router-link to="/editCat/0">Добавить кошку</router-link>
      </el-menu-item>
      <el-menu-item index="1-5">
        <router-link to="/editBreed/0">Добавить породу</router-link>
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
