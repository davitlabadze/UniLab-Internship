<?php

class Solution
{

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Float
     */
    function findMedianSortedArrays($nums1, $nums2)
    {
        $arrMerge = array_merge($nums1, $nums2);
        sort($arrMerge);
        $countArrMerge = count($arrMerge);
        $arrMergeIsOdd = $countArrMerge % 2 != 0;
        return $arrMergeIsOdd ? (float)$arrMerge[count($arrMerge) / 2] : ((float)$arrMerge[(count($arrMerge) / 2) - 1] + (float)$arrMerge[count($arrMerge) / 2]) / 2;
    }
}


//Test Case
$fistSolution = new Solution;
$arr1 = [1, 3];
$arr2 = [2];
print $fistSolution->findMedianSortedArrays($arr1, $arr2) . "\n";


$secondSolution = new Solution;
$arr3 = [1, 3];
$arr4 = [2, 4];
print $secondSolution->findMedianSortedArrays($arr3, $arr4) . "\n";


$thirdSolution = new Solution;
$arr5 = [1, 2, 3];
$arr6 = [];
print $thirdSolution->findMedianSortedArrays($arr5, $arr6) . "\n";

$forthSolution = new Solution;
$arr7 = [];
$arr8 = [1, 2, 3];
print $forthSolution->findMedianSortedArrays($arr7, $arr8) . "\n";



$fifthSolution = new Solution;
$arr9 = [];
$arr10 = [4, 2, 3];
print $fifthSolution->findMedianSortedArrays($arr9, $arr10) . "\n";


$sixthSolution = new Solution;
$arr11 = [2, 3, 6];
$arr12 = [];
print $sixthSolution->findMedianSortedArrays($arr11, $arr12) . "\n";

$seventhSolution = new Solution;
$arr13 = [2, 3, 6];
$arr14 = [3];
print $seventhSolution->findMedianSortedArrays($arr13, $arr14) . "\n";
