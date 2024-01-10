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
        title: "Users",
        columns: ["name", "surname", "email", "tel", "address", "books", "active"],
        data: [],
      },
    };
  },
  created() {
    // Kitapları çek
    axios.get(`http://127.0.0.1:8000/api/user/${this.$route.params.id}`)
      .then(response => {
        console.log(response.data); // İsteğin döndüğü veriyi kontrol et
        // Tek bir kullanıcıyı diziye ekleyerek 'data' prop'unu güncelle
        this.table1.data = [response.data.user];
      })
      .catch(error => {
        console.error("User API Hatası:", error);
      });
  }
};

</script>
