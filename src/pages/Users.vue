<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <card :title="table1.title">
          <base-table :data="table1.data" :columns="table1.columns" thead-classes="text-primary">
            <template v-slot:default="{ row }">
                <td v-for="(column, index) in table1.columns" :key="index">
                  <a v-if="column === 'link'" :href="'/user/' + row.user_id">
                    {{ row[column.toLowerCase()] }}
                  </a>
                  <span v-else>
                    {{ row[column.toLowerCase()] }}
                  </span>
                </td>
                <td>
                  <button @click="goToUser(row.user_id)" style="background-color: transparent; color: #fff; border: none;"><i class="tim-icons icon-zoom-split"></i></button>
                </td>
            </template>
          </base-table>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import { BaseTable } from "@/components";
import axios from "axios";

export default {
  components: {
    BaseTable,
  },
  data() {
    return {
      table1: {
        title: "Users",
        columns: ["user_id", "name", "surname"],
        data: [],
      },
    };
  },
  created() {
    axios.get("http://127.0.0.1:8000/api/users")
      .then(response => {
        this.table1.data = response.data.users;
      })
      .catch(error => {
        console.error("Users API Hatası:", error);
      });
  },
  methods: {
    goToUser(user_id) {
      this.$router.push(`/user/${user_id}`);
    },
  },
};
</script>
