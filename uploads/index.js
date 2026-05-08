function validateForm() {
           
            const requiredFields = ['nim', 'nama_lengkap', 'jurusan'];
            for(let field of requiredFields) {
                const input = document.getElementById(field);
                if(!input.value.trim()) {
                    alert('❌ Field ' + input.previousElementSibling.textContent + ' tidak boleh kosong!');
                    input.focus();
                    return false;
                }
            }

         
            const fotoInput = document.getElementById('foto');
            if(fotoInput.files.length > 0) {
                const file = fotoInput.files[0];
                const maxSize = 2 * 1024 * 1024;
                
              
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if(!allowedTypes.includes(file.type)) {
                    alert('❌ File harus berupa gambar JPG, JPEG, atau PNG!');
                    return false;
                }
                
           
                if(file.size > maxSize) {
                    alert('❌ Ukuran file maksimal 2MB!');
                    return false;
                }
            }
            
            return true;
        }