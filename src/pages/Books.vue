<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <card :title="table2.title">
          <base-table :data="table2.data" :columns="table2.columns" thead-classes="text-primary">
            <template v-slot:default="{ row }">
                <td v-for="(column, index) in table2.columns" :key="index">
                  <a v-if="column === 'link'" :href="'/book/' + row.book_id">
                    {{ row[column.toLowerCase()] }}
                  </a>
                  <!-- Diğer sütunlar için -->
                  <span v-else>
                    {{ row[column.toLowerCase()] }}
                  </span>
                </td>
                <td>
                  <button @click="goToBook(row.book_id)" style="background-color: transparent; color: #fff; border: none;"><i class="tim-icons icon-zoom-split"></i></button>
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
      table2: {
        title: "Books",
        columns: ["book_id", "book_name", "author"],
        data: [],
      },
    };
  },
  created() {
    axios.get("http://127.0.0.1:8000/api/books")
      .then(response => {
        this.table2.data = response.data.books;
      })
      .catch(error => {
        console.error("Books API Hatası:", error);
      });
  },
  methods: {
    goToBook(bookId) {
      this.$router.push(`/book/${bookId}`);
    },
  },
};
</script>
