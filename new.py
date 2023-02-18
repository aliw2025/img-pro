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
print("Number of Contours found = " + str(len(contours)))
# cv2.imshow('image',img);
cv2.imwrite('./storage/app/public/uploads/result.png',img);
cv2.waitKey() 
cv2.destroyAllWindows() 


   

    

