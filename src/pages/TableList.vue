<template>
  <div class="row">
    <div class="col-12">
      <card :title="table1.title">
        <div class="table-responsive">
          <base-table :data="table1.data" :columns="table1.columns" thead-classes="text-primary">
          </base-table>
        </div>
      </card>
    </div>

    <div class="col-12">
      <card class="card-plain">
        <div class="table-full-width table-responsive">
          <base-table :title="table2.title" :sub-title="table2.subTitle" :data="table2.data" :columns="table2.columns">
          </base-table>
        </div>
      </card>
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
        columns: ["user_id", "name", "surname", "address", "tel", "email"],
        data: [],
      },

      table2: {
        title: "Books",
        columns: ["book_id", "book_name", "author"],
        data: [],
      },
    };
  },
  created() {
    // Kullanıcıları çek
    axios.get("http://127.0.0.1:8000/api/users")
      .then(response => {
        this.table1.data = response.data.users;
      })
      .catch(error => {
        console.error("Users API Hatası:", error);
      });

    // Kitapları çek
    axios.get("http://127.0.0.1:8000/api/books")
      .then(response => {
        this.table2.data = response.data.books;
      })
      .catch(error => {
        console.error("Books API Hatası:", error);
      });
  }
};
</script>

<style>
</style>
