<template>
  <footer class="footer">
    <div class="container-fluid">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="">
            Users
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            Books
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            Deliveries
          </a>
        </li>
      </ul>
      <div class="copyright">
        © {{year}} made with <i class="tim-icons icon-heart-2"></i> by
        <a href="">Rest-Full API Library</a>
      </div>
    </div>
  </footer>
</template>
<script>
  export default {
    data() {
      return {
        year: new Date().getFullYear()
      }
    }
  };
</script>
<style>
</style>
