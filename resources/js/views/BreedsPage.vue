<template>
  <div class="common-layout mt-4">
    <el-container>
      <el-header class="page-header">
        <h2>Breeds List</h2>
      </el-header>

      <el-main>
        <router-link :to="`/editBreed/0`">
          <el-button
            type="success"
          >Добавить породу <el-icon :size="20" class="ms-3"><CirclePlus /></el-icon> </el-button>
        </router-link>
        <el-table :data="breeds" border class="mt-3">
          <el-table-column prop="id" label="ID" />
          <el-table-column prop="name" label="Имя" />
          <el-table-column prop="description" label="Описание" />
          <el-table-column prop="long_life" label="Продолжительность жизни" />
          <el-table-column label="Действия">
            <template #default="scope">
              <router-link :to="`/editBreed/${scope.row.id}`">
                <el-button
                  size="small"
                  type="primary"
                >Изменить</el-button>
              </router-link>
              <el-button
                class="ms-3"
                size="small"
                type="danger"
                @click="deleteBreed(scope.row.id, scope.$index)"
              >Удалить</el-button>
            </template>
          </el-table-column>
        </el-table>
      </el-main>
    </el-container>
  </div>
</template>

<script setup>

import axios from "axios";
import {ref, onMounted} from "vue";
let breeds = ref([]);
onMounted(()=>{
  getCatsList()
})

// получаем список всех пород
const getCatsList = () => {
  axios.post('/api/breedsList')
    .then(res=>{
      // если редирект
      if(res.data.redirect) {
        alert('Ошибка!')
        router.push('/editCat/0')
      }
      breeds.value = res.data
    })
}

// удаление породы
const deleteBreed = (id, idx) => {
  if (confirm('Удалить эту породу?')) {
    axios.post('/api/deleteBreed', {
      id: id
    })
      .then(res => {
        if (res.data) {
          breeds.value.splice(idx, 1)
        }
      })
  }
}
</script>

<style scoped>
.page-header {
  text-align: center;
}

</style>
