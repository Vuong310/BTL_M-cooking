-- drop database quan_ly_web_nauan; 
CREATE DATABASE IF NOT EXISTS quan_ly_web_nauan;
USE quan_ly_web_nauan;

-- 1. Bảng vai trò
CREATE TABLE IF NOT EXISTS vai_tro(
	id INT PRIMARY KEY AUTO_INCREMENT,
	ten_vai_tro VARCHAR(20)
);

-- 2. Bảng người dùng
CREATE TABLE IF NOT EXISTS nguoi_dung(
	id INT PRIMARY KEY AUTO_INCREMENT,
	ten_dang_nhap VARCHAR(50) NOT NULL,
	mat_khau VARCHAR(50) NOT NULL,
	ho_ten VARCHAR(50),
	email VARCHAR(50),
	sdt VARCHAR(10),
	vai_tro_id INT,
	ngay_sinh DATETIME,
	FOREIGN KEY (vai_tro_id) REFERENCES vai_tro(id)
);

-- 3. Bảng loại món
CREATE TABLE IF NOT EXISTS loai_mon(
	id INT PRIMARY KEY AUTO_INCREMENT,
	ten_loai VARCHAR(20)
);

-- 4. Bảng công thức
CREATE TABLE IF NOT EXISTS cong_thuc(
	id INT PRIMARY KEY AUTO_INCREMENT,
	ten_mon_an VARCHAR(100) NOT NULL,
	mo_ta TEXT,
	thoi_gian_nau INT,
	nguoi_dang_id INT,
	ngay_dang DATE,
	hinh_anh VARCHAR(255),
    buoc_lam TEXT,
    trang_thai VARCHAR(20),
	FOREIGN KEY (nguoi_dang_id) REFERENCES nguoi_dung(id)
);

-- 5. Bảng nguyên liệu
CREATE TABLE IF NOT EXISTS nguyen_lieu(
	id INT PRIMARY KEY AUTO_INCREMENT,
	ten_nguyen_lieu VARCHAR(50)
);

-- 6. Bảng liên kết công thức với nguyên liệu
CREATE TABLE IF NOT EXISTS cong_thuc_nguyen_lieu(
	id INT PRIMARY KEY AUTO_INCREMENT,
	cong_thuc_id INT,
	nguyen_lieu_id INT,
	so_luong VARCHAR(50),
	FOREIGN KEY (cong_thuc_id) REFERENCES cong_thuc(id),
	FOREIGN KEY (nguyen_lieu_id) REFERENCES nguyen_lieu(id)
);
-- 7. Bảng liên kết công thức với loại món
CREATE TABLE IF NOT EXISTS loai_mon_cong_thuc(
	id INT PRIMARY KEY AUTO_INCREMENT,
	cong_thuc_id INT,
	loai_mon_id INT,
	FOREIGN KEY (loai_mon_id) REFERENCES loai_mon(id),
	FOREIGN KEY (cong_thuc_id) REFERENCES cong_thuc(id)
);


SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE loai_mon_cong_thuc;
TRUNCATE TABLE cong_thuc_nguyen_lieu;
TRUNCATE TABLE cong_thuc;
TRUNCATE TABLE nguyen_lieu;
TRUNCATE TABLE loai_mon;
TRUNCATE TABLE nguoi_dung;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO vai_tro ( ten_vai_tro) VALUES
('Admin'),
('Người dùng');

INSERT INTO nguoi_dung(ten_dang_nhap, mat_khau, ho_ten, email, sdt, vai_tro_id, ngay_sinh) VALUES
('admin', 'admin123', 'Quản trị viên', 'admin@congthuc.vn', '0900000000', 1, '2000-01-01'),
('linh01', 'pass123', 'Nguyễn Văn Linh', 'linh01@gmail.com', '0901000001', 2, '2000-03-15'),
('mai02', 'pass123', 'Trần Thị Mai', 'mai02@gmail.com', '0901000002', 2, '2001-07-22'),
('hoang03', 'pass123', 'Hoàng Minh', 'hoang03@gmail.com', '0901000003', 2, '2002-11-30'),
('thu04', 'pass123', 'Lê Thu Hà', 'thu04@gmail.com', '0901000004', 2, '2003-05-10'),
('khanh05', 'pass123', 'Phạm Khánh', 'khanh05@gmail.com', '0901000005', 2, '2004-08-18'),
('anh06', 'pass123', 'Đỗ Anh Tuấn', 'anh06@gmail.com', '0901000006', 2, '2005-12-05'),
('hoa07', 'pass123', 'Nguyễn Thị Hoa', 'hoa07@gmail.com', '0901000007', 2, '2006-04-27'),
('minh08', 'pass123', 'Vũ Minh Quân', 'minh08@gmail.com', '0901000008', 2, '2007-09-09'),
('hien09', 'pass123', 'Bùi Thị Hiền', 'hien09@gmail.com', '0901000009', 2, '2008-06-12'),
('nam10', 'pass123', 'Trịnh Văn Nam', 'nam10@gmail.com', '0901000010', 2, '2009-02-20'),
('lan11', 'pass123', 'Đặng Lan Anh', 'lan11@gmail.com', '0901000011', 2, '2000-10-01'),
('son12', 'pass123', 'Ngô Văn Sơn', 'son12@gmail.com', '0901000012', 2, '2001-03-03'),
('trang13', 'pass123', 'Phan Thị Trang', 'trang13@gmail.com', '0901000013', 2, '2002-07-07'),
('tuan14', 'pass123', 'Lê Tuấn Kiệt', 'tuan14@gmail.com', '0901000014', 2, '2003-01-25'),
('my15', 'pass123', 'Nguyễn Thị Mỹ', 'my15@gmail.com', '0901000015', 2, '2004-11-11'),
('duy16', 'pass123', 'Trần Duy Hưng', 'duy16@gmail.com', '0901000016', 2, '2005-08-08'),
('yen17', 'pass123', 'Lê Thị Yến', 'yen17@gmail.com', '0901000017', 2, '2006-09-19'),
('phuc18', 'pass123', 'Nguyễn Phúc', 'phuc18@gmail.com', '0901000018', 2, '2007-05-05'),
('nga19', 'pass123', 'Đinh Thị Nga', 'nga19@gmail.com', '0901000019', 2, '2008-12-12'),
('huy20', 'pass123', 'Phạm Huy Hoàng', 'huy20@gmail.com', '0901000020', 2, '2009-06-06'),
('thao21', 'pass123', 'Trần Thị Thảo', 'thao21@gmail.com', '0901000021', 2, '2000-02-02'),
('long22', 'pass123', 'Ngô Văn Long', 'long22@gmail.com', '0901000022', 2, '2001-10-10'),
('nhung23', 'pass123', 'Vũ Nhung', 'nhung23@gmail.com', '0901000023', 2, '2002-03-30'),
('bao24', 'pass123', 'Lê Quốc Bảo', 'bao24@gmail.com', '0901000024', 2, '2003-09-15'),
('giang25', 'pass123', 'Nguyễn Thị Giang', 'giang25@gmail.com', '0901000025', 2, '2004-07-07'),
('quang26', 'pass123', 'Phan Quang', 'quang26@gmail.com', '0901000026', 2, '2005-01-01'),
('thuong27', 'pass123', 'Đặng Thương', 'thuong27@gmail.com', '0901000027', 2, '2006-04-04'),
('tam28', 'pass123', 'Trần Văn Tâm', 'tam28@gmail.com', '0901000028', 2, '2007-02-22'),
('nhan29', 'pass123', 'Bùi Nhân', 'nhan29@gmail.com', '0901000029', 2, '2008-08-08'),
('mai30', 'pass123', 'Lê Mai', 'mai30@gmail.com', '0901000030', 2, '2009-06-06');

INSERT INTO loai_mon(ten_loai) VALUES
('Á'), ('Âu - Mỹ'), ('Việt Nam'), ('Trung Quốc'), 
('Nhật Bản'), ('Hàn Quốc'), ('Pháp'), ('Ấn Độ'),
('Mặn'), ('Chay'), ('Ăn kiêng'), ('Giảm cân'), 
('Giàu Protein'), ('Khô'), ('Nước'), ('Nguội'), 
('Nóng'), ('Khai vị'), ('Món chính'), ('Tráng miệng'), 
('Đồ ngọt'), ('Đồ Uống'), ('Ăn vặt'), ('Luộc'), 
('Chiên/Rán'), ('Hấp'), ('Xào'), ('Nướng/Quay'),
('Kho'), ('Ninh/Hầm'), ('Từ Thịt'), ('Từ Hải Sản'), 
('Từ Tinh bột'), ('Từ Rau củ'), ('Món Gia đình'), ('Món ăn nhanh'), 
('Món tại Nhà hàng'), ('Ẩm thực đường phố'), ('Muối lên men'), ('Ăn nhanh'),('Trung Đông');

INSERT INTO cong_thuc (ten_mon_an, mo_ta, thoi_gian_nau, nguoi_dang_id, ngay_dang, hinh_anh, buoc_lam, trang_thai) VALUES
('Phở Bò', 'Món phở truyền thống Việt Nam với nước dùng thơm ngon.', 60, 5, '2025-01-10', 'Pho_Bo.jpg', 'Chuẩn bị xương bò|Ninh nước dùng|Trụng bánh phở|Thêm thịt bò và rau thơm', 'da_duyet'),
('Bún Chả', 'Đặc sản Hà Nội với thịt nướng và bún ăn kèm nước chấm.', 45, 8, '2025-01-12', 'Bun_Cha.jpg', 'Ướp thịt|Nướng thịt|Luộc bún|Pha nước chấm|Dọn ra ăn kèm rau sống', 'da_duyet'),
('Sushi Nhật', 'Món ăn nổi tiếng của Nhật Bản với cơm cuộn và hải sản.', 50, 12, '2025-01-15', 'Sushi_Nhat.jpg', 'Nấu cơm|Chuẩn bị hải sản|Cuộn sushi|Cắt miếng|Trang trí và thưởng thức', 'cho_duyet'),
('Pizza Ý', 'Bánh pizza Ý với phô mai và sốt cà chua đặc trưng.', 40, 7, '2025-01-20', 'Pizza_Y.jpg', 'Nhào bột|Phết sốt cà chua|Thêm phô mai và topping|Nướng bánh|Cắt và ăn nóng', 'da_duyet'),
('Bánh Mì Việt Nam', 'Bánh mì kẹp thịt nổi tiếng của Việt Nam.', 20, 9, '2025-01-22', 'Banh_Mi_Viet_Nam.jpg', 'Chuẩn bị bánh mì|Làm nhân thịt|Thêm rau và nước sốt|Kẹp nhân vào bánh mì', 'da_duyet'),
('Tacos Mexico', 'Món ăn đường phố Mexico với bánh ngô và nhân thịt.', 30, 14, '2025-01-25', 'Tacos_Mexico.jpg', 'Chuẩn bị bánh ngô|Làm nhân thịt|Thêm rau và phô mai|Cuộn lại và thưởng thức', 'cho_duyet'),
('Cơm Tấm', 'Món cơm tấm đặc sản miền Nam Việt Nam.', 35, 6, '2025-01-28', 'Com_Tam.jpg', 'Nấu cơm tấm|Nướng sườn|Làm bì chả|Dọn cơm với nước mắm', 'da_duyet'),
('Pad Thai', 'Món mì xào nổi tiếng của Thái Lan.', 25, 11, '2025-02-02', 'Pad_Thai.jpg', 'Ngâm mì|Xào tôm và trứng|Thêm sốt Pad Thai|Trộn mì|Ăn kèm lạc rang', 'cho_duyet'),
('Bánh Xèo', 'Bánh xèo giòn rụm ăn kèm rau sống và nước chấm.', 30, 15, '2025-02-05', 'Banh_Xeo.jpg', 'Pha bột|Đổ bánh|Thêm nhân|Cuốn với rau sống|Chấm nước mắm', 'da_duyet'),
('Kimchi Hàn Quốc', 'Món kimchi lên men nổi tiếng của Hàn Quốc.', 120, 18, '2025-02-08', 'Kimchi_Han_Quoc.jpg', 'Chuẩn bị cải thảo|Pha sốt ớt|Trộn kimchi|Ủ lên men|Ăn kèm cơm', 'cho_duyet'),
('Bò Kho', 'Món bò kho Việt Nam thơm ngon.', 90, 20, '2025-02-10', 'Bo_Kho.jpg', 'Ướp thịt bò|Xào bò với gia vị|Ninh bò với nước|Ăn kèm bánh mì hoặc cơm', 'da_duyet'),
('Hamburger Mỹ', 'Bánh hamburger với thịt bò và phô mai.', 25, 22, '2025-02-12', 'Hamburger_My.jpg', 'Nướng thịt bò|Chuẩn bị bánh mì|Thêm rau và phô mai|Kẹp nhân vào bánh', 'cho_duyet'),
('Bánh Cuốn', 'Món bánh cuốn Việt Nam mềm mịn.', 40, 24, '2025-02-15', 'Banh_Cuon.jpg', 'Pha bột|Tráng bánh|Làm nhân|Cuốn bánh|Ăn kèm nước mắm', 'da_duyet'),
('Curry Ấn Độ', 'Món cà ri đậm đà hương vị Ấn Độ.', 60, 26, '2025-02-18', 'Curry_An_Do.jpg', 'Xào hành tỏi|Thêm gia vị|Nấu thịt với nước sốt|Ăn kèm cơm hoặc bánh mì', 'cho_duyet'),
('Bánh Chưng', 'Món bánh truyền thống Việt Nam dịp Tết.', 240, 28, '2025-02-20', 'Banh_Chung.jpg', 'Chuẩn bị lá dong|Làm nhân|Gói bánh|Luộc bánh nhiều giờ|Ăn cùng dưa hành', 'da_duyet'),
('Spaghetti Ý', 'Món mì Ý với sốt cà chua và thịt bò.', 35, 10, '2025-02-22', 'Spaghetti_Y.jpg', 'Luộc mì|Làm sốt cà chua|Xào thịt bò|Trộn mì với sốt|Ăn nóng', 'cho_duyet'),
('Bánh Bao', 'Bánh bao nhân thịt hấp nóng hổi.', 50, 13, '2025-02-25', 'Banh_Bao.jpg', 'Nhào bột|Làm nhân|Gói bánh|Hấp bánh|Ăn nóng', 'da_duyet'),
('Falafel Trung Đông', 'Món chay nổi tiếng từ Trung Đông.', 40, 16, '2025-02-28', 'Falafel_Trung_Dong.jpg', 'Xay đậu|Trộn gia vị|Nặn viên|Chiên vàng|Ăn kèm bánh pita', 'cho_duyet'),
('Bánh Tét', 'Món bánh truyền thống miền Nam Việt Nam.', 240, 19, '2025-03-02', 'Banh_Tet.jpg', 'Chuẩn bị lá chuối|Làm nhân|Gói bánh|Luộc bánh nhiều giờ|Ăn cùng dưa món', 'da_duyet'),
('Ramen Nhật', 'Món mì ramen nổi tiếng của Nhật Bản.', 90, 21, '2025-03-05', 'Ramen_Nhat.jpg', 'Nấu nước dùng|Luộc mì|Chuẩn bị topping|Cho mì vào bát|Thêm nước dùng', 'cho_duyet'),
('Bánh Khọt', 'Món bánh khọt giòn ngon của miền Nam.', 30, 23, '2025-03-08', 'Banh_Khot.jpg', 'Pha bột|Đổ bánh|Thêm nhân|Ăn kèm rau sống và nước mắm', 'da_duyet'),
('Paella Tây Ban Nha', 'Món cơm hải sản nổi tiếng Tây Ban Nha.', 70, 25, '2025-03-10', 'Paella_Tay_Ban_Nha.jpg', 'Xào hành tỏi|Thêm hải sản|Nấu cơm với nước dùng|Trang trí với chanh', 'cho_duyet'),
('Bánh Đúc', 'Món bánh đúc dân dã Việt Nam.', 40, 27, '2025-03-12', 'Banh_Duc.jpg', 'Pha bột|Đổ khuôn|Hấp bánh|Ăn kèm nước mắm', 'da_duyet'),
('Shawarma Trung Đông', 'Món thịt nướng cuốn bánh pita.', 50, 29, '2025-03-15', 'Shawarma_Trung_Dong.jpg', 'Ướp thịt|Nướng thịt|Cắt lát|Cuốn với bánh pita|Ăn kèm rau', 'cho_duyet'),
('Ức gà áp chảo', 'Món ăn ít dầu mỡ, giàu protein.', 25, 29, '2025-03-15', 'Uc_Ga_Ap_Chao.jpg', 'Ướp ức gà|Áp chảo không dầu|Thêm rau củ luộc|Dùng nóng', 'cho_duyet'),
('Đậu hũ kho nấm', 'Món chay thanh đạm, đậm vị.', 30, 29, '2025-03-15', 'Dau_Hu_Kho_Nam.jpg', 'Cắt đậu hũ|Xào nấm|Kho cùng gia vị|Thêm hành lá', 'da_duyet'),
('Canh chua chay', 'Món canh chua thanh mát với rau củ và đậu hũ.', 30, 29, '2025-03-15', 'Canh_Chua_Chay.jpg', 'Chuẩn bị rau củ|Cắt đậu hũ|Nấu nước dùng|Thêm gia vị chua|Cho rau vào', 'cho_duyet'),
('Miến xào chay', 'Món miến xào với nấm, rau củ, ít dầu mỡ.', 25, 29, '2025-03-15', 'Mien_Xao_Chay.jpg', 'Ngâm miến|Xào rau củ|Thêm nấm|Cho miến vào|Nêm gia vị', 'da_duyet'),
('Cà ri chay', 'Món cà ri thơm béo với khoai, cà rốt, đậu hũ.', 40, 29, '2025-03-15', 'Ca_Ri_Chay.jpg', 'Chuẩn bị rau củ|Xào sơ|Nấu với nước cốt dừa|Thêm gia vị cà ri|Ăn kèm bánh mì hoặc cơm', 'cho_duyet'),
('Bánh Kem', 'Đồ ngọt sẽ giúp bản giảm stress!!', 90, 3, '2025-11-28', 'Banh_Kem.jpg', 'Làm côt bánh|Đánh kem phủ|Phủ và Trang trí', 'cho_duyet'),
('Salad Hy Lạp', 'Salad rau củ tươi với phô mai feta và dầu ô liu.', 20, 29, '2025-03-15', 'Salad_Hy_Lap.jpg', 'Rửa rau|Cắt nhỏ|Trộn với dầu ô liu|Thêm phô mai feta', 'da_duyet'),
('Bánh quy bơ', 'Bánh quy giòn thơm vị bơ.', 40, 29, '2025-03-15', 'Banh_Quy_Bo.jpg', 'Trộn bột|Nhào bột|Tạo hình|Nướng bánh', 'cho_duyet'),
('Chè đậu xanh', 'Món chè ngọt mát, bổ dưỡng.', 40, 29, '2025-03-15', 'Che_Dau_Xanh.jpg', 'Nấu đậu xanh|Thêm đường|Cho nước cốt dừa|Ăn kèm đá', 'cho_duyet'),
('Bánh su kem', 'Bánh ngọt mềm với nhân kem béo ngậy.', 60, 29, '2025-03-15', 'Banh_Su_Kem.jpg', 'Nấu bột|Tạo hình|Nướng bánh|Bơm kem vào nhân', 'da_duyet'),
('Kem vani', 'Món kem mát lạnh vị vani.', 120, 29, '2025-03-15', 'Kem_Vani.jpg', 'Đánh trứng sữa|Thêm vani|Đông lạnh|Xới kem', 'cho_duyet'),
('Bánh mochi', 'Bánh ngọt Nhật Bản dẻo thơm.', 50, 29, '2025-03-15', 'Banh_Mochi.jpg', 'Trộn bột nếp|Nhào bột|Tạo hình|Thêm nhân|Hấp chín', 'da_duyet'),
('Panna cotta', 'Món tráng miệng Ý mềm mịn, thơm béo.', 180, 29, '2025-03-15', 'Panna_Cotta.jpg', 'Nấu kem sữa|Thêm gelatin|Đổ khuôn|Làm lạnh|Trang trí trái cây', 'da_duyet'),
('Bánh flan', 'Món bánh ngọt mềm mịn với caramel.', 60, 29, '2025-03-15', 'Banh_Flan.jpg', 'Nấu caramel|Đánh trứng sữa|Đổ khuôn|Hấp cách thủy|Làm lạnh', 'cho_duyet'),
('Trà chanh', 'Nước uống giải khát mát lạnh, chua ngọt.', 10, 29, '2025-03-15', 'Tra_Chanh.jpg', 'Pha trà|Thêm đường|Vắt chanh|Cho đá|Khuấy đều', 'da_duyet'),
('Nước ép cam', 'Nước ép cam tươi mát giàu vitamin C.', 10, 29, '2025-03-15', 'Nuoc_Ep_Cam.jpg', 'Rửa cam|Cắt đôi|Vắt lấy nước|Thêm đá', 'cho_duyet'),
('Cà phê sữa đá', 'Đồ uống truyền thống Việt Nam, đậm đà vị cà phê.', 10, 29, '2025-03-15', 'Ca_Phe_Sua_Da.jpg', 'Pha cà phê|Thêm sữa đặc|Cho đá|Khuấy đều', 'cho_duyet'),
('Trà sữa trân châu', 'Thức uống ngọt ngào, béo ngậy với trân châu dai giòn.', 20, 29, '2025-03-15', 'Tra_Sua_Tran_Chau.jpg', 'Nấu trân châu|Pha trà|Thêm sữa|Cho đá|Trộn đều', 'da_duyet'),
('Sinh tố dâu', 'Sinh tố trái dâu tươi mát, giàu vitamin.', 15, 29, '2025-03-15', 'Sinh_To_Dau.jpg', 'Rửa dâu|Cắt nhỏ|Xay với sữa|Thêm đá|Rót ra ly', 'cho_duyet'),
('Nước ép táo', 'Nước ép táo ngọt dịu, tốt cho sức khỏe.', 10, 29, '2025-03-15', 'Nuoc_Ep_Tao.jpg', 'Rửa táo|Cắt miếng|Ép lấy nước|Thêm đá', 'cho_duyet'),
('Soda chanh bạc hà', 'Đồ uống giải khát sảng khoái, mát lạnh.', 10, 29, '2025-03-15', 'Soda_Chanh_Bac_Ha.jpg', 'Vắt chanh|Thêm đường|Cho soda|Thêm lá bạc hà|Cho đá', 'da_duyet');

INSERT INTO nguyen_lieu(ten_nguyen_lieu) VALUES
('Đường'),('Muối'),('Tiêu đen'),('Bột ngọt'),('Hạt nêm'),
('Nước mắm'),('Dầu ăn'),('Dầu oliu'),('Nước tương'),('Sữa tươi'),
('Bơ'),('Phô mai'),('Sốt cà chua'),('Sốt mayonnaise'),
('Tương ớt'),('Hành lá'),('Hành tím'),('Tỏi'),('Gừng'),('Ớt'),
('Khoai tây'),('Cà rốt'),('Cà chua'),('Hành tây'),('Rau thơm'),
('Ngò rí'),('Rau mùi'),('Sả'),('Nấm hương'),('Nấm rơm'),
('Bột mì'),('Bột bắp'),('Bột chiên giòn'),('Gạo'),('Bún tươi'),('Miến'),('Mì gói'),
('Thịt bò'),('Thịt heo'),('Thịt gà'),('Cá hồi'),('Tôm'),('Mực'),
('Trứng gà'),('Trứng vịt'),('Cá ngừ'),('Cá thu'),('Cá basa'),('Cua biển'),('Ghẹ'),
('Bạch tuộc'),('Nghêu'),('Sò huyết'),('Hàu'),('Ốc bươu'),('Thịt vịt'),
('Thịt dê'),('Thịt cừu'),('Xương heo'),('Xương bò'),('Đậu hũ'),('Tàu hũ ky'),
('Đậu xanh'),('Đậu đỏ'),('Bắp cải'),('Bông cải xanh'),('Bông cải trắng'),
('Rau cải ngọt'),('Rau muống'),('Nấm kim châm'),('Nấm mối'),('Nấm đông cô'),('Khoai lang'),
('Bí đỏ'),('Nước lọc'),('Rượu vang trắng'),('Mù tạt'),('Mật ong'),('Bột gạo'),
('Gelatin'),('Bột năng'),('Siro'),('Cam'),('Táo'),('Dưa hấu'),
('Xoài'),('Chanh'),('Cải thảo'),('Hạt diêm mạch'),('Hành boa rô'),
('Bánh phở tươi'),('Hẹ'),('Quế'),('Hoa hồi'),('Thảo anh'),('Đinh hương'),('Hạt mùi khô'),
('Ớt bột Hàn Quốc'),('Nước xốt gia vị bò kho'),('Bánh Hamburger'),('Dưa chuột'),
('Gạo nếp'),('Lá chuối'),('Lạt tre'),('Lá dứa'),('Bột nếp'),('Tôm khô'),('Xà lách'),
('Mộc nhĩ'),('Kem tươi'),('Gia vị masala'),('Lá dong'),
('Hạt óc chó'),('Mì spaghetti'),('Giá đỗ'),('Men nở'),('Trứng cút'),('Đậu gà'),
('Bột rau mùi'),('Bột thìa là'),('Rau parsley'),('Sữa tươi không đường'),('Vani'),
('Bột cacao nguyên chất'),('Rượu rum'),('Sữa đặc'),('Trà đen'),
('Nước cốt chanh'),('Đá viên'),('Bạc hà'),('Bột cà phê'),('Nước cốt dừa'),
('Bột cà ri'),('Đường đen'),('Bột sữa béo'),('Bột nở'),('Đường bột'),('Cà chua bi'),('Oliu đen'),
('Lá oregano khô'),('Dâu tây'),('Soda'),('Siro bạc hà'),('Rau chân vịt'),('Hạt chia'),
('Rau sống'),('Giấm'),('Đu đủ xanh'),('Thanh cua'),('Rong biển'),('Wasabi'),
('Gừng ngâm'),('Bột bánh xèo'),('Mì ramen'),('Xương gà'),('Rượu Mirin'),('Rượu sake'),
('Bột nghệ'),('Gạo ngắn valencia Tây Ba Nha'),('Ức gà'),('Ớt chuông'),('Đậu Hà Lan'),
('Ớt bột Tây Ba Nha'),('Nước dùng gà'),('Nấm mèo'),('Bột ớt'),('Bột quế'),('Bột đinh hương'),
('Bánh mì dẹt'),('Lá húng quế'),('Hạt điều'),('Đậu phụ non'),('Dứa'),('Me chua'),('Mì gạo'),
('Lạc rang'),('Sườn heo'),('Thính gạo rang'),('Bánh ngô (tortilla)'),('Phô mai bào'),
('Phô mai Mozzarella'),('Xúc xích'),('Bánh mì'),('Tương cà'),('Đậu bắp');

INSERT INTO cong_thuc_nguyen_lieu(cong_thuc_id, nguyen_lieu_id, so_luong) VALUES
(1, 60, '1-1.5 kg'), (1, 38, '500 gram'), (1, 91, '500 gram'), (1, 93, '2 thanh nhỏ (~5g)'), (1, 94, '3-4 cái (~5g)'), (1, 95, '2 quả (~3g)'), (1, 96, '2-3 cái'), (1, 97, '1 thìa cà phê (~3g)'), (1, 19, '1 củ (~50g)'), (1, 17, '3-4 củ (~40g)'), (1, 24, '1 củ (~150g)'), (1, 2, '2 muỗng canh'), (1, 1, '2 muỗng canh'), (1, 6, '3 muỗng canh'), (1, 5, '1 muỗng canh'), (1, 3, '1/2 thìa cà phê'), (1, 16, '50g'), (1, 27, '25g'), (1, 26, '25g'), (1, 115, '200g'), (1, 87, '2 quả'), (1, 20, '2-3 quả'),
(2, 39, '(Ba chỉ) 500g'), (2, 39, '(Nạc vai) 300g'), (2, 35, '1kg'), (2, 146, ''), (2, 6, '8 thìa canh'), (2, 1, '5 thìa canh'), (2, 78, '1 thìa canh'), (2, 3, '1/2 thìa cà phê'), (2, 17, '1 củ'), (2, 18, '1 củ'), (2, 147, '2 thìa canh'), (2, 75, '200ml'), (2, 20, '2 quả'), (2, 22, '1 củ'), (2, 148, '1 miếng nhỏ'),
(3, 34, '500g'), (3, 147, '80ml'), (3, 1, '40g'), (3, 2, '10g'), (3, 41, ''), (3, 46, ''), (3, 42, ''), (3, 149, ''), (3, 150, '6-8 lá'), (3, 101, ''), (3, 22, ''), (3, 9, ''), (3, 151, ''), (3, 152, ''),
(4, 31, '250g'), (4, 116, '5g'), (4, 75, '150ml'), (4, 2, '1/2 thìa cà phê'), (4, 7, '1 thìa canh'), (4, 13, '3-4 thìa canh'), (4, 181, '150g'), (4, 182, '3-4 cái'),
(5, 182, '2 cái'), (5, 38, '200g'), (5, 12, '2 lát/50g'), (5, 108, ''), (5, 101, ''), (5, 15, '2-3 thìa'), (5, 184, '2-3 thìa'), (5, 2, ''), (5, 3, ''), (5, 7, ''),
(6, 179, '6-8 cái'), (6, 38, '150g'), (6, 40, '150g'), (6, 2, '2g'), (6, 3, '1g'), (6, 20, ''), (6, 108, ''), (6, 23, '2 quả'), (6, 180, '50g'),
(7, 34, '500g'), (7, 176, '400g'), (7, 39, '200g'), (7, 178, ''), (7, 44, '2 quả'), (7, 6, '3 thìa'), (7, 1, '2 thìa'), (7, 75, '100ml'), (7, 87, '18'), (7, 20, ''), (7, 146, ''),
(8, 175, '200g'), (8, 42, '200g'), (8, 44, '2 quả'), (8, 115, '100g'), (8, 16, '30g'), (8, 6, '1 thìa'), (8, 1, '1 thìa'), (8, 174, ''), (8, 7, '2 thìa canh'), (8, 177, '30g'),
(9, 153, '400g'), (9, 75, '500ml'), (9, 132, '200ml'), (9, 2, '1/2 thìa cà phê'), (9, 16, '30g'), (9, 39, '(Ba chỉ) 200g'), (9, 42, '200g'), (9, 115, '200g'), (9, 146, ''), (9, 6, '4 thìa'), (9, 1, '2 thìa'), (9, 87, ''), (9, 18, ''), (9, 20, ''),
(10, 88, '3kg'), (10, 92, '240g'), (10, 98, '350g'), (10, 16, '130g'), (10, 19, '20g'), (10, 18, '80g'), (10, 22, '300g'), (10, 84, '300g'), (10, 24, '1 củ'), (10, 106, '70g'), (10, 107, '50g'), (10, 1, '150g'), (10, 2, '100g'),
(11, 38, '500 gram'), (11, 22, '2 củ'), (11, 28, '3 nhánh'), (11, 19, '1 nhánh'), (11, 20, '1 ít'), (11, 81, '2 muỗng canh'), (11, 24, '1 củ'), (11, 17, '4 củ'), (11, 6, '2 muỗng canh'), (11, 7, '2 muỗng canh'), (11, 1, '1 ít'), (11, 2, '1 ít'), (11, 3, '1 ít'), (11, 99, '1 gói'),
(12, 100, '4 bánh'), (12, 11, ''), (12, 12, '4 lát'), (12, 23, '1 quả'), (12, 24, '1/2 củ'), (12, 101, '1 quả'), (12, 38, '500 gram'), (12, 3, ''), (12, 13, '1/3 chén'), (12, 14, '1 muỗng canh'), (12, 108, '4 lá'),
(13, 79, '300g'), (13, 81, '100g'), (13, 2, '1 thìa cà phê'), (13, 75, '600ml'), (13, 7, '1 thìa canh'), (13, 39, '300g'), (13, 109, '100g'), (13, 29, '50g'), (13, 24, '1 củ'), (13, 6, '1 ít'), (13, 3, '1 ít'), (13, 5, '1 ít'),
(14,40,'500g'), (14,23,'2 quả'), (14, 24, '1 củ'), (14, 18, '3 – 4 tép'), (14, 19, '1 nhánh'), (14, 110, '200ml'), (14,7, '2 thìa canh'), (14, 26, 'để trang trí'), (14, 111, '1 gói'),
(15, 102, '2kg'), (15, 63, '500g'), (15, 39, '(Ba chỉ) 600 – 800g'), (15, 112, '40 – 50 lá'), (15, 104, 'để buộc bánh'), (15, 2, 'tùy khẩu vị'), (15, 3, '1 thìa cà phê'), (15, 17, '4 củ'),
(16,114, '400g'), (16, 13, '2 thìa canh'), (16, 38, 'xay 300g'), (16, 23, 'chín 2 quả'), (16, 24, '1 củ'), (16, 18, '3 tép'), (16, 8, '2 thìa canh'), (16, 2, '1 thìa cà phê'), (16, 3, '1 thìa cà phê'), (16, 12, 'Parmesan bào vụn 50g'),
(17, 31, 'đa dụng 500g'), (17, 116, '7g'), (17, 10, '(ấm) 250ml'), (17, 1, '50g'), (17, 7, '30g'), (17, 2, '2 thìa'), (17, 39, 'xay (nạc vai hoặc ba chỉ) 300g'), (17, 117, '4 – 5 quả'), (17, 109, '50g'), (17, 29, '50g'), (17, 24, '1 củ'), (17, 3, '1 ít'), (17, 6, '2 thìa canh'),
(18, 118, 'khô 250g'), (18, 24, '1 củ nhỏ'), (18, 18, '3 – 4 tép'), (18, 27, '1 nắm'), (18,121, '1 nắm'), (18, 120, '1 thìa cà phê'), (18, 119, '1 thìa cà phê'), (18, 116, '1/2 thìa cà phê'), (18, 31, '2 – 3 thìa canh'), (18, 2, 'vừa ăn'), (18, 7,''),
(19,102, '400 gram'), (19,63, '200 gram'), (19,104, '1 bó'), (19,105, '1 bó'), (19,5, '1 ít'), (19,2, '1 ít'), (19,3, '1 ít'),
(20,154, '500 gram'), (20,39,'250 gram'), (20,50, '750 gram'), (20,155, '150 gram'), (20,44, '1 quả'), (20,9,'240 ml'), (20, 156, '60 ml'), (20, 157, '60 ml'), (20, 29, '20 gram'), (20, 19, '1 nhánh nhỏ'), (20,16, '3 nhánh'), (20, 2, '1 ít'), (20,3, '1 ít'), (20,19, '3-4 tép'), (20, 90, '1 cây'),
(21,79, '250 gram'), (21, 33, '50 gram'), (21, 158, '10 gram'), (21,81, '50 gram'), (21, 132, '200 ml'), (21,75, '200ml'), (21,16, '2 cây'), (21,44, '1 quả'), (21,2, '1 ít'), (21,1, '1 ít'), (21,154, '1 ít'), (21,42, '200 gram'),
(22,159, '300 gram'), (22, 42, '300 gram'), (22,160, '300 gram'), (22, 161, '1 quả'), (22, 24, '1 củ'), (22, 18, '4 tép'), (22, 162, '50-70 gram'), (22, 115, '3-4 thìa'), (22,163, '1 thìa'), (22, 2, '1 ít'), (22,3,'1 ít'), (22, 8, '1 ít'), (22, 158, '1 ít'), (22, 164, '800-900 ml'),
(23, 79, '200 gram'), (23, 81, '50 gram'), (23, 75, '1 lit'), (23, 106, '50 gram'), (23, 39, '200 gram'), (23, 29, '20 gram'), (23, 165, '20 gram'), (23, 27, '1 ít'), (23, 18, '1 ít'), (23, 20, '1 ít'), (23, 17, '2 củ'), (23, 147, '1 thìa canh'), (23, 7, '1 thìa canh'), (23, 6, '2 thìa canh'), (23,2, '1 ít'), (23, 1, '1 ít'), (23, 3, '1 ít'),
(24, 40, '900 gram'), (24, 18, '4-5 tép'), (24, 158, '1 thìa cà phê'), (24, 166, '1 thìa cà phê'), (24, 167, '1/2 thìa cà phê'), (24, 168, '1/4 thìa cà phê'), (24, 128, '2-3 thìa canh'), (24, 8, '60ml'), (24, 2, '1 thìa cà phê'), (24, 169, '4-6 cái'), (24, 101, '2 quả'), (24, 27, '15 gram'), (24, 24, '1 củ'), (24, 23, '2 quả'),
(25, 160, '2 miếng'), (25,170, '20 gram'), (25, 18, '2 tép'), (25, 17, '3 củ'), (25, 20, '3 trái'), (25,171, '20 gram'), (25,8, '1 ít'), (25, 2, '1 ít'), (25, 1, '1 ít'), (25, 3, '1 ít'),
(26,61, '3 miếng'), (26, 16, '40 gram'), (26, 20, '3 quả'), (26, 4, '1 ít'), (26, 9, '1 ít'), (26, 1, '1 ít'), (26, 3, '1 ít'),
(27, 172, '1 hộp'), (27, 173, '1 lát'), (27, 23, '2 quả'), (27, 185, '200 gram'), (27, 130, '4 nhánh'), (27,174, '1 ít'), (27, 90, '1 cây'), (27, 1 , '1 ít'), (27, 2, '1 ít'),
(28, 36, '150 gram'), (28, 30, '80 gram'), (28, 22, '50 gram'), (28, 65, '80 gram'), (28, 24, '1/2 củ'), (28, 16, '2 cây'), (28, 7, '15 ml'), (28, 9, '20 ml'), (28, 2, '3 gram'), (28, 1, '5 gram'),
(29, 21, '150 gram'), (29, 22, '100 gram'), (29, 61, '200 gram'), (29, 24, '1 củ'), (29, 132, '200 ml'), (29, 133, '10 gram'), (29, 2, '5 gram'), (29, 1, '10 gram'), (29, 7, '20 ml'), (29, 75, '300 ml'),
(30, 31, '200 gram'), (30, 1, '100 gram'), (30, 11, '100 gram'), (30, 44, '3 quả'), (30, 10, '50 ml'), (30, 136, '5 gram'), (30, 110, '200 ml'), (30, 137, '30 gram'), (30, 123, '2 ml'),
(31, 101, '100 gram'), (31, 138, '100 gram'), (31, 24, '1/2 củ'), (31, 139, '30 gram'), (31, 12, '50 gram'), (31, 8, '15 ml'), (31, 2, '2 gram'), (31, 3, '1 gram'), (31, 140, '1 gram'),
(32, 31, '200 gram'), (32, 11, '120 gram'), (32, 1, '80 gram'), (32, 44, '1 quả'), (32, 123, '2 ml'), (32, 2, '1 gram'),
(33, 63, '150 gram'), (33, 1, '80 gram'), (33, 141, '400 gram'), (33, 132, '100 ml'), (33, 2, '1 gram'),
(34, 31, '120 gram'), (34, 11, '80 gram'), (34, 1, '30 gram'), (34, 44, '3 quả'), (34, 141, '150 ml'), (34, 10, '200 ml'), (34, 110, '100 ml'), (34, 123, '2 ml'),
(35, 10, '300 gram'), (35, 110, '200 gram'), (35, 1, '80 gram'), (35, 44, '3 quả'), (35, 123, '3 ml'),
(36, 106, '150 gram'), (36, 1, '50 gram'), (36, 10, '150 ml'), (36, 81, '20 gram'), (36, 64, '100 gram'), (36, 7, '10 ml'),
(37, 122, '125 ml'), (37, 110, '135 ml'), (37, 1, '45 gam'), (37, 123, '1/4 thìa cafe'), (37, 80, '5 gam'), (37, 124, '5 gam'), (37, 125, '5 ml'),
(38, 122, '400 ml'), (38, 1, '70 gam'), (38, 126, '1 lon'), (38, 87, '1/4 quả'),
(39, 127, '10 gam'), (39, 75, '200 ml'), (39, 1, '10 gam'), (39, 128, '10 ml'), (39, 78, '10 ml'), (39, 129, '200 gam'), (39, 87, '1 quả'), (39, 130, '2 nhánh'),
(40, 83, '2 quả'), (40, 1, '20 gam'), (40, 129, '100 gam'),
(41, 131, '200 gam'), (41, 126, '40 ml'), (41, 129, '100 gam'), (41, 75, '460 ml'),
(42, 81, '150 gam'), (42, 124, '15 gam'), (42, 134, '200 gam'), (42, 75, '200 ml'), (42, 31, '20 gam'), (42, 127, '100 gam'), (42, 10, '200 ml'), (42, 135, '100 gam'), (42, 1, '200 gam'), (42, 75, '2 lít'), (42, 129, '200 gam'),
(43, 141, '200 gam'), (43, 126, '150 ml'), (43, 10, '200 ml'), (43, 2, '5 gam'), (43, 129, '50 gam'),
(44, 84, '4 quả'), (44, 1, '150 gam'), (44, 87, '1/2 quả'), (44, 75, '100 ml'),
(45, 142, '200 ml'), (45, 87, '1 quả'), (45, 130, '50 gam'), (45, 129, '100 ml'), (45, 143, '20 ml'), (45, 1, '50 gam'), (45, 2, '5 gam');

INSERT INTO loai_mon_cong_thuc(cong_thuc_id, loai_mon_id) VALUES 
(1, 1), (1, 3), (1, 9), (1, 15), (1, 17), (1, 19), (1, 31), (1, 33), (1, 37), (1, 38), 
(2, 1), (1, 3), (1, 9), (1, 14), (1, 15), (1, 16), (1, 17), (1, 19), (1, 28), (1, 31), (1, 33), (1, 37), (1, 38), 
(3, 1), (3, 5), (3, 9), (3, 14), (3, 16), (3, 19), (3, 23), (3, 32), (3, 33), (3, 37), 
(4, 2), (4, 9), (4, 14), (4, 17), (4, 19), (4, 23), (4, 28), (4, 33), (4, 36), (4, 37), (4, 38), (4, 41),
(5, 1), (5, 3), (5, 9), (5, 14), (5, 19), (5, 23), (5, 31), (5, 33), (5, 36), (5, 38), 
(6, 40), (6, 38), (6, 31), (6, 23), (6, 16), (6, 9), (6, 2), 
(7, 1), (7, 3), (7, 9), (7, 14), (7, 17), (7, 19), (7, 28), (7, 31), (7, 33), (7, 35), (7, 37),
(8, 1),  (8, 9),  (8, 14),  (8, 19), (8, 32), (8, 33),  (8, 37),  (8, 38),  (8, 39), 
(9, 1), (9, 3), (9, 9), (9, 14), (9, 19), (9, 23), (9, 25), (9, 31), (9, 32), (9, 35), (9, 37), (9, 38), 
(10, 6), (10, 11), (10,12), (10, 9), (10, 10), (10, 18), (10, 34), (10, 39),
(11, 3), (11, 9), (11, 17), (11, 29), (11, 30), (11, 19), (11, 31),
(12, 2), (12, 38), (12, 40), (12, 17), (12, 28), (12, 25), (12, 19), (12, 31), (12, 33),
(13, 3), (13, 17), (13, 26), (13, 19), (13, 33), (13, 31),
(14, 8), (14, 9), (14, 17), (14, 30), (14, 27), (14, 19), (14, 31), (14, 34),
(15, 3), (15, 35), (15, 17), (15, 24), (15, 19), (15, 33), (15, 31),
(16, 2), (16, 9), (16, 17), (16, 24), (16, 27), (16, 19), (16, 31), (16, 33),
(17, 4), (17, 17), (17, 26), (17, 19), (17, 33), (17, 31),
(18, 41), (18, 10), (18, 11), (18, 25), (18, 19), (18, 34), (18, 33),
(19, 3), (19, 9), (19, 16), (19, 19), (19, 24), (19, 33), (19, 35),
(20, 1), (20, 5), (20, 15), (20, 17), (20, 19), (20, 33), (20, 36),
(21, 1), (21, 3), (21, 9), (21, 23), (21, 25), (21, 32), (21, 33), (21, 38),
(22, 2), (22, 9), (22, 13), (22, 17),  (22, 19), (22, 27), (22, 31), (22, 32), (22, 35), (22, 37),
(23, 1), (23, 3), (23, 9), (23, 14), (23, 16), (23, 23), (23, 33), (23, 35),
(24, 1), (24, 9), (24, 13), (24, 14), (24, 17), (24, 23), (24, 33), (24, 38), (24, 36),
(25, 1), (25, 9), (25, 11), (25, 12), (25, 13), (25, 14), (25, 19), (25, 25), (25, 31),
(26, 1), (26, 3), (26, 9), (26, 10), (26, 11), (26, 17), (26, 19), (26, 35),
(27, 1), (27, 3), (27, 10), (27, 11), (27, 13), (27, 15), (27, 17), (27, 19), (27,35),
(28,1), (28,3), (28,10), (28,17), (28,19), (28,27), (28,34), (28,35), 
(29,1), (29,8), (29,10), (29,17), (29,19), (29,27), (29,34), (29,35),
(30,2), (30,16), (30,20), (30,21), (30,23), (30,28), (30,33), (30,37),
(31,2), (31,11), (31,12), (31,16), (31,18), (31,34), (31,35), (31,37),
(32,2), (32,16), (32,21), (32,23), (32,28), (32,33),
(33,1), (33,3), (33,15), (33,16), (33,17), (33,20), (33,21), (33,30), (33,34), (33,35), (33,38),
(34,2), (34,7), (34,16), (34,20), (34,21), (34,28), (34,33), (34,37), (34,38), 
(35,2), (35,16), (35,20), (35,21), (35,23), (35,33), (35,35),
(36,5), (36,16), (36,21), (36,23), (36,26), (36,33), (36,35), (36,38),
(37, 20), (37, 21), (37,2),
(38, 20), (38, 21), (38, 35), (38, 2), (38, 3),
(39, 22), (39, 23), (39, 38), (39, 3),
(40, 22), (40, 23), (40, 36), (40, 2),
(41, 22), (41, 38), (41, 3),
(42, 22), (42, 21), (42, 23), (42, 1),
(43, 22), (43, 21), (42, 23), (42, 2),
(44, 22), (44, 23), (44, 36), (44, 2),
(45, 22), (45, 23), (45, 36), (45, 2);

