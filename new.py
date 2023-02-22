import cv2 as cv2
import sys
import numpy as np;
import skimage
from numpy import matlib as mb
from skimage.color import rgb2hsv



def createMask(RGB):
    # print(RGB[:,:,0]);
    # print(RGB[:,:,1]);
    # print(RGB[:,:,2]);
    # I = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)
    I = rgb2hsv(img)
    # cv2.imshow('image',I);
    # print('after');
    # print(I[:,:,0]);
    channel1Min = 0.871;
    channel1Max = 0.104;

    channel2Min = 0.213;
    channel2Max = 1;

    channel3Min = 0.000;
    channel3Max = 229.000;
  
    sliderBW = ( (I[:,:,0] >= channel1Min) | (I[:,:,0] <= channel1Max) ) & (I[:,:,1] >= channel2Min ) & (I[:,:,1] <= channel2Max) & ( I[:,:,2] >= channel3Min ) & (I[:,:,2] <= channel3Max);
    BW = sliderBW;
    maskedRGBImage = RGB;
    k = np.tile(~BW,[1 ,1, 3])
    # print(k[:,:,0]);
    np.put(maskedRGBImage,k,0)
    # cv2.imshow('image',maskedRGBImage);

    cv2.waitKey() 
    cv2.destroyAllWindows() 
    return maskedRGBImage


img = cv2.imread('./storage/app/public/uploads/'+sys.argv[1],1); 

img2 = createMask(img)  

edged = cv2.Canny(img, 30, 200)
contours, hierarchy = cv2.findContours(edged, 
    cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_NONE)
cv2.drawContours(img, contours, -1, (0,255,0), 3)

img2 = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
ret, img2= cv2.threshold(img2,0,255,cv2.THRESH_BINARY+cv2.THRESH_OTSU)

contours2, hierarchy2 = cv2.findContours(edged, 
    cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_NONE)
cv2.drawContours(img2, contours2, -1, (0,255,0), 3)

print(contours)
print(contours2)

cv2.imshow('image',img2);
cv2.waitKey() 
# B2 = bwboundaries(img2);

count1 = size(B,1);
# for i=1:count1
#     tmp1(i) = size(B{i},1);
# end

# s = size(B2,1);
# for i=1:s
#     tmp2(i) = size(B2{i},1);
# end

# a = size(tmp1(tmp1>3),2);
# b = size(tmp2(tmp2>3),2);


# %adjustment based on calibration
# count1 = 100*count1/s;
# count2 = 135.5*a/(b);
print("Number of Contours found = " + str(len(contours)))
# cv2.imshow('image',img);
cv2.imwrite('./storage/app/public/uploads/result.png',img);
cv2.waitKey() 
cv2.destroyAllWindows() 


   

    

