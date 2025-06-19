document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk tombol tambah ke keranjang
    document.querySelectorAll('.btn-add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const menuId = this.dataset.menuId;
            
            // Simpan ke localStorage sebagai contoh
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Cari apakah menu sudah ada di keranjang
            const existingItem = cart.find(item => item.menuId === menuId);
            
            if (existingItem) {
                // Jika sudah ada, tambah jumlahnya
                existingItem.quantity = (existingItem.quantity || 1) + 1;
            } else {
                // Jika belum ada, tambahkan baru
                cart.push({
                    menuId: menuId,
                    quantity: 1
                });
            }
            
            // Simpan kembali ke localStorage
            localStorage.setItem('cart', JSON.stringify(cart));
            
            // Tampilkan notifikasi
            alert('Menu berhasil ditambahkan ke keranjang!');
        });
    });
});
