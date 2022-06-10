clc; clear;

%Siapkan 3 citra grayscale
Image1 = imread('yuli.png');
Image2 = imread('yuli1.png');
Image3 = imread('yuli2.png');

I1 = rgb2gray(Image1);
I2 = rgb2gray(Image2);
I3 = rgb2gray(Image3);

%Lakukan transformasi fourier
I1_TF = log(1+abs(fft2(I1)));
I2_TF = log(1+abs(fft2(I2)));
I3_TF = log(1+abs(fft2(I3)));

%Tampilkan domain spasial dan domain frekuensi
figure(1), 
subplot(2,3,1),imshow(I1),title('citra 1 domain spasial')
subplot(2,3,2),imshow(I2),title('citra 2 domain spasial')
subplot(2,3,3),imshow(I3),title('citra 3 domain spasial')
subplot(2,3,4),imshow(I1_TF,[]),title('citra 1 domain frekuensi')
subplot(2,3,5),imshow(I2_TF,[]),title('citra 2 domain frekuensi')
subplot(2,3,6),imshow(I3_TF,[]),title('citra 3 domain frekuensi')

%lakukan pergeseran pixel ke kanan sebanyak 10 pixel pada salah satu citra
[baris, kolom] = size(I1);
I1_Geser = zeros(baris,kolom);
for i = 1:1:baris
    for j=1:1:(kolom-50)
        a = I1(i,j);
        I1_Geser(i,j+50) = a;
    end
end
I1_Geser = uint8(I1_Geser);

%Lakukan transformasi fourier pada citra hasil pergeseran
I1_GeserTF = log(1+abs(fft2(I1_Geser)));

%Tampilkan image hasil pergeseran dalam domain spasial dan frekuensi
figure(2),
subplot(2,2,1),imshow(I1_Geser),title('Citra Pergeseran Domain Spasial')
subplot(2,2,2),imshow(I1_GeserTF,[]),title('Citra Pergeseran Domain Frekuensi')
