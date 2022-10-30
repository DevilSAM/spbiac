<template>
  <div class="common-layout mt-4">
    <el-container>
      <el-header class="page-header">
        <h2>Cats List</h2>
      </el-header>

      <el-main>
        <router-link :to="`/editCat/0`">
          <el-button
            type="success"
          >Add a cat <el-icon :size="20" class="ms-3"><CirclePlus /></el-icon> </el-button>
        </router-link>

        <el-table :data="cats" border class="mt-3" :row-class-name="tableRowClassName">
          <el-table-column prop="image" label="Photo">
          <template #default="scope">
            <el-image :src="`${scope.row.image}`" :fit="`contain`" class="cat-photo " />
          </template>
          </el-table-column>
          <el-table-column prop="name" label="Name" />
          <el-table-column prop="age" label="Age" />
          <el-table-column prop="breed.name" label="Breed" />
          <el-table-column label="Actions">
            <template #default="scope">
              <router-link :to="`/editCat/${scope.row.id}`">
                <el-button
                  size="small"
                  type="primary"
                >Change<el-icon class="ms-2"><Edit /></el-icon> </el-button>
              </router-link>
              <el-button
                class="ms-3"
                size="small"
                type="danger"
                @click="deleteCat(scope.row.id, scope.$index)"
              >Delete<el-icon class="ms-2"><Delete /></el-icon></el-button>
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
let cats = ref([]);

// действие при загрузке компонента
onMounted(()=>{
  getCatsList()
})

// получаем список всех котиков
const getCatsList = () => {
  axios.post('/api/catsList')
  .then(res=>{
    cats.value = res.data
  })
}

// удаление конкретного котейки
const deleteCat = (id, idx) => {

  if (confirm('Delete this cat?')) {
    axios.post('/api/deleteCat', {
      id: id
    })
      .then(res => {
        if(res.data) {
          cats.value.splice(idx, 1)
        }
      })
  }
}

// определяем цвет строки таблицы
const tableRowClassName = (row, rowIndex) => {

  if(Math.abs(row.row.age - row.row.breed.long_life) <= 3) {
    return 'danger-row'
  }

  return ''
}


</script>

<style scoped >

.page-header {
  text-align: center;
}
.cat-photo {
  height: 150px;
  width: 100%;
}
</style>
