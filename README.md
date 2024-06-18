# training_intern

# Bài tập training PHP phần 1 - Tìm hiểu về Laravel 11

## Mô tả

Xây dựng trang web quản lý timesheet với các mô tả nghiệp vụ như sau:

1.1. Mỗi timesheet có các nội dung như sau:
- Ngày (ví dụ 2018-08-14)
- Các công việc đã làm trong ngày (multiple line). Mỗi line có dạng:
  - Task ID (nếu không có thì để là "N/A")
  - Nội dung task
  - Thời gian sử dụng
- Các khó khăn gặp phải (text)
- Các dự định sẽ làm trong ngày tiếp theo (text)

1.2. Mô tả use case của nhân viên
- Nhân viên có trang cá nhân, có thể sửa đổi các thông tin sau:
  - password, avatar, description
- Mỗi ngày nhân viên cần phải vào trang web để tạo timesheet
- Hệ thống sẽ tự động ghi nhận:
  - Số lần nhân viên đăng ký timesheet trong tháng (kể cả làm đúng giờ hay làm bổ sung)
  - Số lần mỗi nhân viên chậm làm timesheet theo tháng
- Sau khi tạo timesheet, nhân viên có quyền sửa nội dung timesheet
- Nhân viên có thể truy cập trang danh sách, liệt kê các timesheet của mình theo tuần / tháng.

## Yêu cầu

2.1. Đọc hiểu mô tả nghiệp vụ. Vẽ biểu đồ use case cơ bản.

2.2. Xây dựng cấu trúc database. Tạo file GoogleSheet theo mẫu.

https://docs.google.com/spreadsheets/d/1yo7DOcFnZ939w4OnVug2Pgaa1EVY7XquwHXn3pt_eZ8/edit?usp=sharing

2.3. Tạo code base cơ bản:
- PHP 8.1, MariaDB
- Laravel 1111
- migrations
- layouts

2.4. Code chức năng nhân viên
- Màn hình nhân viên login
- Màn hình tạo timesheet
- Màn hình danh sách timesheet
- Màn hình view chi tiết timesheet
- Màn hình chỉnh sửa timesheet

2.5. Các chức năng nâng cao
- Chức năng phân quyền trong hệ thống (Yêu cầu tìm hiểu về Policy trong Laravel):
  - Tạo thêm field role trong table users, định nghĩa quyền cho các user trong hệ thống như sau 
    |  Roles | Function  |
    |---|---|
    | Admin  | Có thể duyệt timesheet của tất cả mọi người, có thể quản lý user, export timesheet  |
    | Manager  |  Chỉ duyệt được timesheet của những người thuộc quyền mình quản lý |
    | User  |  Chỉ tạo được timesheet và sửa được timesheet của bản thân mình |
  - Khi user truy cập vào các page mà mình ko có quyền truy cập thì xử lý lỗi 403
- Thêm màn hình hiển thị list time sheet bằng calendar  (Yêu cầu sử dụng 1 plugin js)
- Sử dụng bootstrap 5 để customize lại giao diện của hệ thống



# Git flow

## 1, Tổng quan

Tài liệu này mô tả các vấn đề:

- Mô hình branch
- Trình tự thực hiện một task
- Các lệnh git thường gặp

## 2, Mô hình branch

![gitflow](https://gist.githubusercontent.com/tuanle/26e8e3c7e714b45112c1bfeb797a62cb/raw/e8ef2f15271296f25f70aacdd7fcfb2b7498426d/03.gitflow.jpg)

- Một branch được coi như một "phiên bản" của code base, nhằm phục vụ cho một mục đích nào đó
- Mỗi branch gồm nhiều commit, mỗi commit là một "lần sửa đổi" code base.

Các branch được chia thành hai loại như sau:

### 2.1, Branch chính

- Là những branch tồn tại trong suốt quá trình phát triển (lifetime).
- Protected, không nên thực hiện các hành động sau:
	- Xóa branch
	- Rebase, cherry-pick, hoặc bất cứ hành động thay đổi cấu trúc tree commit

Các branch chính bao gồm:

#### 2.1.1, master

- Là branch chứa code hoàn thiện nhất (sau khi code, review, test) và có thể bàn giao hoặc deploy lên production server
- Thường được deploy trên môi trường production.

#### 2.1.2, develop

- Là branch chứa code mới nhất trong quá trình phát triển (sau khi code, unit test, review), đang đợi tester test lại và fixbug.
- Thường được deploy trên môi trường testing.

### 2.2, Branch phụ

- Là những branch chỉ tồn tại trong một giai đoạn nào đó của quá trình phát triển (limited)
- Vòng đời của một branch phụ:
	- Tách nhánh (checkout) từ một trong các branch chính
	- Chỉnh sửa code
	- Hợp nhất (merge) với một hoặc cả hai branch chính
	- Xóa branch

Các branch phụ có thể bao gồm:

#### 2.2.1, feature

- Dùng để phát triển tính năng mới hoặc fixbug trong quá trình phát triển.
- Checkout từ `develop`. Merge vào `develop`
- Tùy theo chức năng, có thể đặt tên với tiền tố `feature-`, `enhancement-`, `bug-` hoặc đơn giản là chỉ dùng thống nhất tiền tố `feature-`
- Các task không có redmine issue, nên được đặt với tiền tố `support-`
- Quy ước đặt tên:

```
feature-{redmine-issue-id}-mô-tả-ngắn-gọn
```

Ví dụ với task phát triển cho issue 20001, sẽ được đặt tên là:

```
feature-20001-create-user-page
```

#### 2.2.2, release

- Dùng để chuyển giao code từ branch `develop` sang branch `master`
- Checkout từ `develop`. Merge vào cả `master` và `develop`
- Trong trường hợp code release có bug, có thể tạm tách branch `release-fix-` từ branch `release-`, fixbug và merge vào branch `release-`. Trong trường hợp này bắt buộc phải merge lại branch `release-` vào branch `develop-`
- Trong trường hợp code release không có bug, thông thường sẽ không cần phải merge lại branch `release-` vào branch `develop-`
- Quy ước đặt tên:

```
release-X.X
```

Với X.X là phiên bản (version) của application tại thời điểm release, ví dụ với phiên bản là 0.1, sẽ được đặt tên là:

```
release-0.1
```

#### 2.2.3, hotfix

- Dùng để fixbug phát sinh trên môi trường production sau khi đã release.
- Checkout từ `master`. Merge vào cả `master` và `develop`
- Quy ước đặt tên:

```
hotfix-X.X.Y
```

Với X.X là phiên bản (version) vừa release, Y là thứ tự bản hotfix, ví dụ với phiên bản là 0.1, bản fix thứ nhất, sẽ được đặt tên là:

```
hotfix-0.1.1
```

### 2.3, Hệ thống tag

- Nhằm đánh dấu các version của application, xuất `changelog` khi có yêu cầu
- Các thời điểm cần đánh dấu tag (lightweight tag):
    - Bắt đầu dự án

    ```
    git tag v0.1
    ```

    - Ngay trước khi merge code release

    ```
    git tag v0.2
    ```

    - Ngay trước khi merge code hotfix

    ```
    git tag v0.2.1
    ```

- Xuất `changelog`

```
git log --no-merges v0.2...v0.1
```

## 3, Trình tự thực hiện task

### 3.1, Yêu cầu chung

- Một task cần phải được thực hiện trên một branch phụ, không được thực hiện trực tiếp trên branch chính
- Một task trước khi merge vào branch chính cần được
	- Merge code mới nhất từ branch chính đã checkout
	- Unit test theo testcase và fix hết các bug trên feature branch
	- Tối thiểu hóa số commit phát sinh, tốt nhất nên là 1 commit trên 1 branch phụ
	- Viết commit message theo đúng quy ước
	- Tạo merge request
	- Review code

### 3.2, Trình tự thực hiện

Giả sử một developer cần làm một task được giao bởi redmine issue 20001, các bước mà anh ta cần thực hiện như sau:

#### 3.2.1, Tách nhánh

- Chuyển branch hiện tại sang `develop`
  ```
  git checkout develop
  ```
- Lấy code mới nhất từ remote
	```
    git pull origin `develop`
    ```
- Tách sang nhánh mới
	```
    git checkout -b feature-20001
    ```

#### 3.2.2, Code
- ....

#### 3.2.3, Unit test theo testcase
- Unit test theo testcase sẵn có của tester, nếu dự án chưa có testcase thì phải test theo quan điểm chung của công ty.
- Yêu cầu trước khi tạo commit phải fix hết các bug khi unit test.

#### 3.2.4, Tạo commit

- Xem trạng thái hiện tại trên branch
	```
    git status
    ```
- Add/Update/Remove các file code thay đổi
	```
    git add file.php
    git add -u file2.php
    git rm file3.php
    ```
    Lưu ý: Có thể add folder để tăng tốc dộ, tuy nhiên không nên sử dụng lệnh `git add .`

- Kiểm tra lại lần cuối trạng thái staged
	```
    git status
    ```
- Tạo commit
	```
    git commit
    ```

    Lưu ý: Không nên sử dụng lệnh `git commit -m` để tránh việc viết commit message oneline.

    Quy ước về viết commit message:

    - Bao gồm hai phần: subject (%s) và body (%b)
    - Subject không quá 50 kí tự
    - Body markdown. bắt buộc có tag `Resolves`
    - Mỗi phần tách nhau bởi một dòng trắng
    - Ví dụ:
    	```txt
        Init code for login function (L001 page)
        {BLANK LINE}
        - Add login route, controller, view
        - Add AuthService, SmsNotification, CreatedUserEvent
        - Resolves #20001
        {BLANK LINE}
        ```
#### 3.2.5, (Optional) Gộp commit (Áp dụng nếu đã commit >= 2 commit trên branch)

- Kiểm tra số lượng commit từ commit tree:

```
git log --oneline -10
```

- Nếu có 2 commit trở lên tính từ merge request gần nhất thì cần phải gộp các commit này với nhau:

```
git rebase -i HEAD~2
use f (fixup) option
```

(Chú ý: `HEAD~2` là ví dụ với trường hợp cần gộp 2 commit, trường hợp cần gộp 3 commit là `HEAD~3`, tương tự `HEAD~4`, ...)

#### 3.2.6, Kiểm tra và cập nhật thay đổi mới nhất có thể phát sinh

- Cập nhật git reference
	```
    git fetch origin
    ```
- Trong trường hợp nhánh develop đã có sự thay đổi, cần cập nhật
	```
    git pull --rebase origin develop
    ```
- Sửa conflict

#### 3.2.7, Tạo merge request

- Push code
	```
    git push origin feauture-20001
    ```
- Tạo merge request với nhánh develop trên Github, Gitlab, ...
- Assign merge request cho người review code

#### 3.2.8, Technical leader review code

#### 3.2.9, Sửa comment

- Trong trường hợp review code có comment, developer cần sửa lại code theo comment
- Thực hiện lại các bước 3.2.3 (với commit message bất kỳ)
- Rebase code (để merge code với commit đã có trước đó)
	```
    git rebase -i HEAD~2
    use f (fixup) option
    ```
- Thực hiện lại bước 3.2.4
- Push code
	```
    git push -f origin feature-20001
    ```
#### 3.2.10, Technial leader merge code và xóa branch

- Dùng chức năng merge và xóa branch trên Github, Gitlab
- Hoặc sử dụng lệnh
	```
    git merge --no-ff feature-20001
    git push origin :feature-20001
    ```

    # Review Code

## Quan điểm chung

- **Code phải hoạt động**
- Code phải dễ đọc hiểu (Sách tham khảo : The art of readable code)

    _Bad code_
    ```php
    function getUser() {}
    function getUser2() {}
    function getUser2() {}
    ```
    _Good code_
    ```php
    function getUser() {}
    function getUserById() {}
    function getAdminUsers() {}
    ```
- Phải tuân thủ theo coding convention (e.g: [PSR-12](https://www.php-fig.org/psr/psr-12/))
- Đặt tên phải ngắn gọn dễ hiểu
- Đặt tên phải đúng chính tả
- Không được phép sử dụng [magic numbers](http://c2.com/cgi/wiki?MagicNumber)
  
    _Bad code_
    ```php
    $total = 1.08 * $price;
    ```
    _Good code_
    ```php
    const TAX_RATE = 1.08;
	$total = TAX_RATE * $price;
    ```
- Tất cả các biến phải được sử dụng ở phạm vi nhỏ nhất có thể
- Không được có các phần code bị comment out
- Không có các đoạn code không chạy, các đoạn code không sử dụng đến
- Không  viết các đoạn code mà đã có sẵn trong các lib
  
    _Bad code_
    ```php
    $startDate = strtotime('2022-10-14');
    $endDate = strtotime('2022-10-20');
    
    $dateDiff = $endDate - $startDate;
    echo round($dateDiff / (60 * 60 * 24));
    ```
    _Good code_
    ```php
    $startDate = Carbon::parse('2022-10-14');
    $endDate = Carbon::parse('2022-10-20');
    
    echo $endDate->diffInDays($startDate);
    ```
- Code không được lặp lại
- Không sử dụng các expression dài dòng và khó hiểu
  
    _Bad code_
    ```php
    $a =  (true == true ? 'A' : 'B') ? 'C' : 'D'; 
    ```
- Không đặt tên biến có chứa các từ ngữ phủ định gây khó hiểu như no, not...
  
    _Bad code_
    ```php
    $hasNoValues = true;
    
    if ($hasNoValue) {
        doSomething()
    }
    ```
    _Good code_
    ```php
    $hasValues = false;
    
    if (!$hasValues) {
        doSomething()
    }
    ```
- Không có các block code rỗng
- Sử dụng các cấu trúc chuẩn của language (e.g: Array, List...)
- Sử dụng catch để bắt các exception cụ thể
- Không sử dụng == và === lẫn với nhau trong cùng 1 đoạn code xử lý
- Các vòng lặp phải hữu hạn và có điều kiện kết thúc rõ ràng
- Các vòng lặp lồng nhau phải viết cụ thể điều kiện kết thúc của từng vòng lặp
- Blocks code bên trong vòng lặp phải đơn giản nhất có thể
- Performance luôn phải được ưu tiên

## Architecture
- Phải sử dụng chính xác theo design pattern của framework (e.g: Service Container, Service Provider, Dependency Injection trong Laravel)
- Một class chỉ nên phục vụ 1 mục đích duy nhất (Single responsibility principle) 
- Classes, modules, functions, etc. cần mở cho sự mở rộng và đóng cho sự thay đổi (Open–closed principle)
- Các object trong chương trình có thể được thay thế bằng các đối tượng con của nó nhưng không làm thay đổi hoạt động của chương trình (Liskov substitution principle)
- Nhiều các interface riêng biệt sẽ tốt hơn sử dụng chung 1 interface (Interface segregation principle)
- Phụ thuộc vào các abtract class chứ không phụ thuộc vào một đối tượng cụ thể (Dependency inversion principle)

## API
- APIs phải check giá trị đầu vào
- API phải có xác thực và phân quyền rõ ràng
- Các API thay đổi phải được phản ánh ngay lập tức vào tài liệu API
- APIs phải trả về status chính xác trong response

## Logging
- Log phải dễ đọc và debug
- Trong các trường hợp lỗi bắt buộc phải ghi log
- Không sử dụng print_r, var_dump hoặc các function tương tự trong code
- Không được in ra các stack traces

## Documentation
- Comments phải thể hiện được mục đích của đoạn code
- Tất cả các method nên có comment rõ ràng
- Tất cả các methods/interfaces/contracts public cần được comment đúng format
- Tất cả các case rẽ nhánh đều nên có comment
- Tất cả các phần xử lý bất thường đều nên có comment

## Security
- Tất cả các input đầu vào đều cần được check security (e.g XSS)
- Cần xử lý các tham số ngoại lệ để tránh code phát sinh lỗi
- Không có thông tin nhạy cảm nào được ghi lại hoặc hiển thị trong stacktrace
