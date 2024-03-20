class customeData{
    brandByCategory(id){
          axios.get('/api/getBrandByCategory/'+id)
            .then(res => {
                return res.data;
            })
            .catch(err => {
                console.log(err);
            })
    }
}

export default customeData = new customeData();
