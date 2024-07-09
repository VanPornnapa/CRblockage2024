<template>
  <select id="river_type" name="river_type" v-model="val" required>
    <option value="0">-- เลือกประเภท --</option>
    <option value="แม่น้ำสายหลัก">แม่น้ำสายหลัก</option>
    <option value="แม่น้ำสาขา">แม่น้ำสาขา</option>
    <option value="ลำห้วย">ลำห้วย</option>
  </select>
</template>
<script>
  export default {
    props: ['river_type'],
    data () {
      return {
        val: null,
      }
    },
    mounted() {
      this.val=this.river_type;
      console.log(this.val);
    }
  }
</script>