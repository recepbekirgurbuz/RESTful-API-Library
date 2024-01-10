<template>
  <div class="row">
    <div class="col-12">
      <card :title="table1.title">
          <base-table :title="table1.title" :sub-title="table1.subTitle" :data="table1.data" :columns="table1.columns">
          </base-table>
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
        title: "Books",
        columns: ["book_id", "book_name", "author", "deliveries"],
        data: [],
      },
    };
  },
  created() {
    // Kitapları çek
    axios.get(`http://127.0.0.1:8000/api/book/${this.$route.params.id}`)
      .then(response => {
        this.table1.data = response.data.books;
      })
      .catch(error => {
        console.error("Books API Hatası:", error);
      });
  }
};
</script>
