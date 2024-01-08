<template>
  <div>
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <card :title="table2.title">
            <base-table :data="table2.data" :columns="table2.columns" thead-classes="text-primary">
            </base-table>
        </card>
      </div>

      <div class="col-lg-6 col-md-12">
        <card :title="table1.title">
            <base-table :data="table1.data" :columns="table1.columns" thead-classes="text-primary">
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
        columns: ["user_id", "name", "surname", "address", "tel", "email"],
        data: [],
      },

      table2: {
        title: "Books",
        columns: ["book_id", "book_name", "author", 'deliveries'],
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
