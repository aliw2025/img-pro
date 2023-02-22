import cv2 as cv2
import sys
import numpy as np;
import skimage
from numpy import matlib as mb
from skimage.color import rgb2hsv


def createMask(RGB):
   
    I = rgb2hsv(img)
   
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

    np.put(maskedRGBImage,k,0)
    
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

# print(contours)
# print(contours2)

count1 = len(contours[0])
count2 = len(contours2[0])
temp1 = []

for x in contours:
    temp1.append(len(x))

temp2 = []
for y in contours:
    temp2.append(len(y))

temp1a = []
for x in temp1:
    if x >3:
        temp1a.append(x)

temp2a = []
for y in temp2:
    if y >3:
        temp2a.append(y)

a = len(temp1a)
b= len(temp2a)

count1 = 100*count1/count2;
count2 = 135.5*a/(b);

print(count2)
print("Number of Contours found = " + str(len(contours)))
cv2.imwrite('./storage/app/public/uploads/result.png',img);
cv2.waitKey() 
cv2.destroyAllWindows() 





   

    

